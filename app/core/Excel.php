<?php


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel
{
    public function export()
    {
        // Mô phỏng dữ liệu từ database hoặc nguồn dữ liệu khác
        $data = [
            ['Name', 'Email', 'Phone'],
            ['John Doe', 'john@example.com', '123-456-7890'],
            ['Jane Doe', 'jane@example.com', '987-654-3210'],
            // Thêm dữ liệu khác tùy theo nhu cầu của bạn
        ];

        // Tạo một đối tượng Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Lấy đối tượng active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Thêm dữ liệu vào sheet
        foreach ($data as $rowIndex => $rowData) {
            foreach ($rowData as $columnIndex => $value) {
                // Chuyển đổi cột sang định dạng chữ cái (A, B, C, ...)
                $columnLetter = chr(65 + $columnIndex);

                // Đặt giá trị cho ô trong sheet
                $sheet->setCellValue($columnLetter . ($rowIndex + 1), $value);
            }
        }

        // Tạo một đối tượng Xlsx Writer để xuất file
        $writer = new Xlsx($spreadsheet);

        // Đặt header cho file xuất ra
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="exampleWithData.xlsx"');
        header('Cache-Control: max-age=0');

        // Gửi file xuất ra trình duyệt
        $writer->save('php://output');
    }
}
?>