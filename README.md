# ETF-Data-Scraper

This script extracts ETF (Exchange-Traded Fund) symbols and their holdings from ETF Database 
using both PHP and Puppeteer. The extracted data is then saved to a spreadsheet.

**The project consists of two main scripts:**

PHP Script (saveToSpreadsheet.php):
Located in App/Services/SaveToSpreadsheet.php.
Utilizes the EthScrape and Spreadsheet classes from the App\Repositories namespace.
Executes the scraping and saving process.

Puppeteer Script (getETFSymbolsAndHoldings.js):
Located in the root directory.
Utilizes Puppeteer to scrape ETF symbols and their holdings from ETF Database.

**Installation**

**Install PHP dependencies:**

composer install

**Install Node.js dependencies (for Puppeteer):**

npm install


PHP Script
Execute the PHP script with the desired ETF screener URL:
![result](https://github.com/raiviskk/ETF-Data-Scraper/blob/main/Screenshot%202023-12-03%20at%2019.51.07.png)
