<?php
include "../model/config.php";
require '../vendor/autoload.php';
$db = new conection();
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$style_col = [
    'font' => ['bold' => true],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
    ],
    'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
    ]
];
$style_row = [
    'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
    ],
    'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
    ]
];
$sheet->setCellValue('A1', "Data Struktur");
$sheet->mergeCells('A1:D2');
$sheet->getStyle('A1')->getFont()->setBold(true);
$sheet->getStyle('A1')->getFont()->setSize(15);

$sheet->setCellValue('A3', "NO");
$sheet->setCellValue('B3', "USER NAME");
$sheet->setCellValue('C3', "JABATAN");
$sheet->setCellValue('D3', "PARENT JABATAN");

$sheet->getStyle('A3')->applyFromArray($style_col);
$sheet->getStyle('B3')->applyFromArray($style_col);
$sheet->getStyle('C3')->applyFromArray($style_col);
$sheet->getStyle('D3')->applyFromArray($style_col);

$sheet->getRowDimension('1')->setRowHeight(20);
$sheet->getRowDimension('2')->setRowHeight(20);
$sheet->getRowDimension('3')->setRowHeight(20);

$sql = mysqli_query($db->config, "SELECT * from jabatan INNER JOIN user on jabatan.user_id = user.user_id");
$no = 1; 
$row = 4; 
while ($data = mysqli_fetch_array($sql)) { 

    $parenName = [];
    $id_parent = $data['j_parent_id'];
    if($id_parent > 0){
        while($id_parent > 0){
            foreach($db->show_data_parent($id_parent) as $jp){
                $id_parent = $jp['j_parent_id'];
                array_push($parenName,$jp['j_name']);
            }
        }
    }
    $stringName = '';
    if(count($parenName) > 0){
        $reverse = count($parenName);
        while($reverse > 0){
            --$reverse;
            $stringName .= $parenName[$reverse]. '\\';
        }
        $stringName .= $data['j_name'];
    } else {
        $stringName = '-';
    }
    $sheet->setCellValue('A' . $row, $no);
    $sheet->setCellValue('B' . $row, $data['user_name']);
    $sheet->setCellValue('C' . $row, $data['j_name']);
    $sheet->setCellValue('D' . $row, $stringName);

    $sheet->getStyle('A' . $row)->applyFromArray($style_row);
    $sheet->getStyle('B' . $row)->applyFromArray($style_row);
    $sheet->getStyle('C' . $row)->applyFromArray($style_row);
    $sheet->getStyle('D' . $row)->applyFromArray($style_row);
    $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom No
    $sheet->getStyle('B' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Set text left untuk kolom NIS
    $sheet->getRowDimension($row)->setRowHeight(20);
    $no++; 
    $row++; 
}

$sheet->getColumnDimension('A')->setWidth(5); 
$sheet->getColumnDimension('B')->setWidth(15); 
$sheet->getColumnDimension('C')->setWidth(25); 
$sheet->getColumnDimension('D')->setWidth(20); 

$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

$sheet->setTitle("Laporan Data Siswa");

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data Struktur.xlsx"');
header('Cache-Control: max-age=0');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>