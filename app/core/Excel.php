<?php
   // File: controllers/ExcelController.php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls as XlsWriter;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Excel
{
    public function export($data)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Table Orders');

        foreach ($data as $rowIndex => $rowData) {
            foreach ($rowData as $columnIndex => $value) {
                $columnLetter = chr(65 + $columnIndex);
                
                if (!empty($value)) {
                    $sheet->setCellValueExplicit(
                        $columnLetter . ($rowIndex + 1),
                        $value,
                        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
                    );
                }
            }
        }

        $writer = new XlsWriter($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="exampleWithData.xls"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }
}

?>