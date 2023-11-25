<?php


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel
{
    /**
     * @param array $data
     * @return void
     */
    public  function export(array $data):void
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($data as $rowIndex => $rowData) {
            foreach ($rowData as $columnIndex => $value) {
                $columnLetter = chr(65 + $columnIndex);
                $sheet->setCellValue($columnLetter . ($rowIndex + 1), $value);
            }
        }
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="exampleWithData.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
?>