<?php

namespace App\Repositories;

use App\Collections\EtfHoldingsCollections;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Spreadsheet
{
    public function saveToExcel(EtfHoldingsCollections $etfCollection): string
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ETF Symbol');
        $sheet->setCellValue('B1', 'Holding Symbol');
        $sheet->setCellValue('C1', 'Holding Name');
        $sheet->setCellValue('D1', 'Holding Percentage');


        $row = 2;
        foreach ($etfCollection->getAll() as $etf) {
            foreach ($etf->holdings as $holding) {
                $sheet->setCellValue('A' . $row, $etf->symbol);
                $sheet->setCellValue('B' . $row, $holding['holdingSymbol']);
                $sheet->setCellValue('C' . $row, $holding['holdingName']);
                $sheet->setCellValue('D' . $row, $holding['holdingPercentage']);
                $row++;
            }
        }

        $filename = 'etf_data_' . date('Ymd_His') . '.xlsx';


        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        return $filename;
    }


}