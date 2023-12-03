<?php

namespace App\Services;

use App\Repositories\EthScrape;
use App\Repositories\Spreadsheet;

class SaveToSpreadsheet
{
    public function execute($url): void
    {
        $ethData = new EthScrape();
        $spreadSheet = new Spreadsheet();
        $spreadSheet->saveToExcel($ethData->executeScript($url));
    }

}