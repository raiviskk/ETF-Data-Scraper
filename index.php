<?php


use App\Services\SaveToSpreadsheet;

require_once __DIR__ . '/vendor/autoload.php';


$screenerURL = 'https://etfdb.com/screener/#page=1&fifty_two_week_start=47.4&five_ytd_start=0.96';

$etfCollection = new SaveToSpreadsheet();
$etfCollection->execute($screenerURL);
