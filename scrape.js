const puppeteer = require('puppeteer');

async function getETFSymbolsAndHoldings(screenerURL) {
    const browser = await puppeteer.launch({ headless: false });
    const page = await browser.newPage();

    await page.goto(screenerURL);
    await page.waitForSelector('td[data-th="Symbol"]');
    const etfSymbols = await page.$$eval('td[data-th="Symbol"] a', symbols => symbols.map(symbol => symbol.innerText));

    const result = {
        etfSymbols: etfSymbols,
        holdings: {}
    };

    for (const etfSymbol of etfSymbols) {
        const etfURL = `https://etfdb.com/etf/${etfSymbol}/#holdings`;
        await page.goto(etfURL);

        await page.waitForSelector('#etf-holdings > tbody > tr:nth-child(1) td[data-th="Symbol"]');

        const holdingsData = [];
        for (let i = 1; i <= 3; i++) {
            const holdingSymbol = await page.$eval(`#etf-holdings > tbody > tr:nth-child(${i}) td[data-th="Symbol"]`, symbol => symbol.innerText).catch(() => 'N/A');
            const holdingName = await page.$eval(`#etf-holdings > tbody > tr:nth-child(${i}) td[data-th="Holding"]`, name => name.innerText).catch(() => 'N/A');
            const holdingPercentage = await page.$eval(`#etf-holdings > tbody > tr:nth-child(${i}) td[data-th="% Assets"]`, percentage => percentage.innerText).catch(() => 'N/A');

            holdingsData.push({
                holdingSymbol: holdingSymbol,
                holdingName: holdingName,
                holdingPercentage: holdingPercentage
            });
        }

        result.holdings[etfSymbol] = holdingsData;
    }

    await browser.close();

    return JSON.stringify(result);
}

const screenerURL = 'https://etfdb.com/screener/#page=1&fifty_two_week_start=47.4&five_ytd_start=0.96';

getETFSymbolsAndHoldings(screenerURL).then(jsonResult => console.log(jsonResult));
