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

$id_users = (int)$_GET['id_users'];

$query_users = query("SELECT dp.*, u.foto, ml.nama AS nama_lokasi FROM data_peserta dp LEFT JOIN users u ON dp.users_id = u.id LEFT JOIN master_lokasi ml ON dp.id_lokasi = ml.id AND ml.deleted_at IS NULL WHERE dp.deleted_at IS NULL AND u.deleted_at IS NULL AND dp.users_id = $id_users")[0];
$query = query("SELECT da.*,u.nama, ms.nama AS status FROM data_absensi da LEFT JOIN users u ON u.id = da.id_users LEFT JOIN master_status ms ON ms.id = da.keterangan WHERE da.id_users = $id_users ORDER BY tgl_absen DESC");

$sheet->mergecells('A1:F1');
$sheet->setCellValue('A1', 'Data Absensi')->getColumnDimension('A')->setAutoSize(true);

$sheet->setCellValue('A3', 'Nama')->getColumnDimension('A')->setAutoSize(true);
$sheet->setCellValue('B3', ": " . $query_users['nama'])->getColumnDimension('B')->setAutoSize(true);

$sheet->setCellValue('A4', 'Awal PKL')->getColumnDimension('A')->setAutoSize(true);
$sheet->setCellValue('B4', ": " . date('d F Y', strtotime($query_users['tgl_masuk'])))->getColumnDimension('B')->setAutoSize(true);

$sheet->setCellValue('A5', 'Akhir PKL')->getColumnDimension('A')->setAutoSize(true);
$sheet->setCellValue('B5', ": " . date('d F Y', strtotime($query_users['tgl_keluar'])))->getColumnDimension('B')->setAutoSize(true);

$sheet->setCellValue('A6', 'Asal')->getColumnDimension('A')->setAutoSize(true);
$sheet->setCellValue('B6', ": " . $query_users['asal'])->getColumnDimension('B')->setAutoSize(true);

$sheet->setCellValue('A7', 'Lokasi PLK')->getColumnDimension('A')->setAutoSize(true);
$sheet->setCellValue('B7', ": " . $query_users['nama_lokasi'])->getColumnDimension('B')->setAutoSize(true);

$sheet->setCellValue('A9', 'No')->getColumnDimension('A')->setAutoSize(true);
$sheet->setCellValue('B9', 'Tanggal Absen')->getColumnDimension('B')->setAutoSize(true);
$sheet->setCellValue('C9', 'Keterangan')->getColumnDimension('C')->setAutoSize(true);
$sheet->setCellValue('D9', 'Kegiatan')->getColumnDimension('D')->setAutoSize(true);
$sheet->setCellValue('E9', 'Alasan')->getColumnDimension('E')->setAutoSize(true);
$sheet->setCellValue('F9', 'Attachment')->getColumnDimension('F')->setAutoSize(true);

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

// tampil data
$no = 1;
$m = 10; // mulai dari bari ke 5
    

foreach ($query as $data) {
    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setName('Attachment');
    $drawing->setDescription('Attachment');
    $drawing->setPath('../assets/img/attachment/file-absensi/'. $data['attachment']); /* put your path and image here */
    $drawing->setCoordinates('F' . $m);
    $drawing->setHeight(65);
    $drawing->setWidth(65);
    $drawing->setOffsetX(10);
    $drawing->setOffsetY(10);
    $drawing->setWorksheet($spreadsheet->getActiveSheet());

    $sheet->setCellValue('A' . $m, $no++);
    $sheet->setCellValue('B' . $m, date('d-m-Y', strtotime($data['tgl_absen'])));
    $sheet->setCellValue('C' . $m, $data['status']);
    $sheet->setCellValue('D' . $m, $data['kegiatan']);
    $sheet->setCellValue('E' . $m, $data['alasan']);
    // $sheet->setCellValue('F' . $m, $data['attachment']);

    if ($m % 2 == 0) {
    $sheet->getStyle('A'. $m .':' . 'F' . $m)->applyFromArray($first_row);
    
    }else{
        $sheet->getStyle('A'. $m .':' . 'F' . $m)->applyFromArray($second_row);
    } 
    $sheet->getRowDimension($m)->setRowHeight(55);
    $sheet->getStyle('A' . $m . ':' . 'E' . $m)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A' . $m . ':' . 'E' . $m)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);


    $m++;
}

// styling

$spreadsheet->getDefaultstyle()->getFont()->setName('Arial')->setSize(10);

// header 
$sheet->getStyle('A1')->getFont()->setSize(16);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
// $sheet->

// body
$sheet->getStyle('A9:F9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A9:F9')->getFont()->setBold(true);
$sheet->getColumnDimension('F')->setWidth(55);


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
$sheet->getStyle('A9:F' . $baris)->applyFromArray($style);
$sheet->getStyle('A9:F9')->applyFromArray($style_header_table);



$writer = new Xlsx($spreadsheet);
$fileName = 'Data Absensi ' . $query_users['nama'] .'.xlsx'; // nama file ketika di download
$writer->save($fileName);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length: ' . filesize($fileName));
header('Content-Disposition: attachment;filename="' . $fileName . '"');
readfile($fileName); // send file
unlink($fileName); // delete file
exit;