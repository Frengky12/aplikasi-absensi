<?php

session_start();

// check login jika gagal lempar kembali ke login.php
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Anda harus login terlebih dahulu');
            document.location.href = 'login.php';
          </script>";
    exit;
}

require '../config/session.php';

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\style\Alignment;
use PhpOffice\PhpSpreadsheet\style\Fill;



$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$sheet->mergecells('A1:H1');
$sheet->setCellValue('A1', 'Data Peserta PKL')->getColumnDimension('A')->setAutoSize(true);

$sheet->setCellValue('A3', 'No')->getColumnDimension('A')->setAutoSize(true);
$sheet->setCellValue('B3', 'Nama')->getColumnDimension('B')->setAutoSize(true);
$sheet->setCellValue('C3', 'Awal PKL')->getColumnDimension('C')->setAutoSize(true);
$sheet->setCellValue('D3', 'Akhir PKL')->getColumnDimension('D')->setAutoSize(true);
$sheet->setCellValue('E3', 'Asal')->getColumnDimension('E')->setAutoSize(true);
$sheet->setCellValue('F3', 'Status')->getColumnDimension('F')->setAutoSize(true);
$sheet->setCellValue('G3', 'Lokasi PKL')->getColumnDimension('G')->setAutoSize(true);
$sheet->setCellValue('H3', 'Foto')->getColumnDimension('H')->setAutoSize(false);

// Style Row Table
$first_row = [
    'fill'=>[
        'fillType' => Fill::FILL_SOLID,
        'startColor'=> [
            'rgb' => 'F2F2F2'
        ]
    ]
];
$second_row = [
    'fill'=>[
        'fillType' => Fill::FILL_SOLID,
        'startColor'=> [
            'rgb' => 'FFFFFF'
        ]
    ]
];

// query ke database
$query = query("SELECT dp.*,ml.nama AS lokasi, u.foto,
(CASE
 WHEN dp.is_active = 0 THEN 'Aktif'
 WHEN dp.is_active = 1 THEN 'Tidak Aktif'
END) AS status
FROM data_peserta dp 
LEFT JOIN master_lokasi ml ON ml.id = dp.id_lokasi 
LEFT JOIN users u ON u.id = dp.users_id AND u.deleted_at IS NULL 
WHERE dp.deleted_at IS NULL AND ml.deleted_at IS NULL");


// tampil data
$no = 1;
$m = 4; // mulai dari bari ke 3
    

foreach ($query as $data) {
    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setName('Foto');
    $drawing->setDescription('Foto');
    $drawing->setPath('../assets/img/attachment/'. $data['foto']); /* put your path and image here */
    $drawing->setCoordinates('H' . $m);
    $drawing->setHeight(55);
    $drawing->setWidth(55);
    $drawing->setOffsetX(10);
    $drawing->setOffsetY(10);
    $drawing->setWorksheet($spreadsheet->getActiveSheet());

    $sheet->setCellValue('A' . $m, $no++);
    $sheet->setCellValue('B' . $m, $data['nama']);
    $sheet->setCellValue('C' . $m, date('d-m-Y', strtotime($data['tgl_masuk'])));
    $sheet->setCellValue('D' . $m, date('d-m-Y', strtotime($data['tgl_keluar'])));
    $sheet->setCellValue('E' . $m, $data['asal']);
    $sheet->setCellValue('F' . $m, $data['status']);
    $sheet->setCellValue('G' . $m, $data['lokasi']);

    // $sheet->setCellValue('F' . $m, $data['attachment']);

    if ($m % 2 == 0) {
    $sheet->getStyle('A'. $m .':' . 'H' . $m)->applyFromArray($first_row);
    
    }else{
        $sheet->getStyle('A'. $m .':' . 'H' . $m)->applyFromArray($second_row);
    } 
    $sheet->getRowDimension($m)->setRowHeight(55);
    $sheet->getStyle('A' . $m . ':' . 'H' . $m)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A' . $m . ':' . 'H' . $m)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

    $m++;
}

// styling

$spreadsheet->getDefaultstyle()->getFont()->setName('Arial')->setSize(10);

// header 
$sheet->getStyle('A1')->getFont()->setSize(16);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
// $sheet->

// body
$sheet->getStyle('A3:H3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A3:H3')->getFont()->setBold(true);

$sheet->getColumnDimension('F')->setWidth(30);
$sheet->getColumnDimension('G')->setWidth(40);
$sheet->getColumnDimension('H')->setWidth(25);


$style = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$style_header_table = [
    'font'=>[
        'color'=>[
            'rgb' => 'FFFFFF'
        ],
    ],
    'fill'=>[
        'fillType' => Fill::FILL_SOLID,
        'startColor'=> [
            'rgb' => '538ED5'
        ]
    ]
];



$baris = $m - 1;
$sheet->getStyle('A3:H' . $baris)->applyFromArray($style);
$sheet->getStyle('A3:H3')->applyFromArray($style_header_table);



$writer = new Xlsx($spreadsheet);
$fileName = 'Data Peserta PKL Diskominfo.xlsx'; // nama file ketika di download
$writer->save($fileName);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length: ' . filesize($fileName));
header('Content-Disposition: attachment;filename="' . $fileName . '"');
readfile($fileName); // send file
unlink($fileName); // delete file
exit;