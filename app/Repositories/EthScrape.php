<?php

namespace App\Repositories;

use App\Collections\EtfHoldingsCollections;
use App\Models\EtfHoldings;

class EthScrape
{
    public function executeScript($screenerURL): EtfHoldingsCollections
    {
        $command = "node scrape.js \"$screenerURL\"";

        $result = exec($command);

        $decodedResult = json_decode($result, true);

        $etfCollection = new EtfHoldingsCollections();
        foreach ($decodedResult['etfSymbols'] as $symbol) {
            $etf = new EtfHoldings($symbol);
            foreach ($decodedResult['holdings'][$symbol] as $holding) {
                $etf->addHolding($holding);
            }

            $etfCollection->add($etf);
        }

        return $etfCollection;
    }
}