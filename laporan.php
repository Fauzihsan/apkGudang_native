<?php


include 'koneksi.php';
session_start();
$username = $_SESSION['username'];

// memanggil library FPDF
require('fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(190,7,'DAFTAR BARANG DI GUDANG TOKOZ1',0,1,'C');
$pdf->SetFont('Arial','B',12);
date_default_timezone_set('Asia/Jakarta');
$pdf->Cell(190,7,"Last Update On : ".date('l, d-M-Y / H:i:s a'),0,1,'C');
$pdf->Cell(190,7,"Last Update By : $username",0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10,'C');
$pdf->Cell(25,6,'ID Barang',1,0,'C');
$pdf->Cell(40,6,'Jenis Barang',1,0,'C');
$pdf->Cell(45,6,'Merk Barang',1,0,'C');
$pdf->Cell(20,6,'Stock',1,0,'C');
$pdf->Cell(20,6,'Satuan',1,0,'C');
$pdf->Cell(20,6,'@QTY',1,0,'C');
$pdf->Cell(20,6,'Satuan',1,1,'C');

$pdf->SetFont('Arial','',10);

$daftar = mysqli_query($kon, "SELECT * FROM barang");
while ($row = mysqli_fetch_array($daftar)){
    $pdf->Cell(25,6,$row['id'],1,0,'C');
    $pdf->Cell(40,6,$row['jBarang'],1,0,'C');
    $pdf->Cell(45,6,$row['mBarang'],1,0,'C');
    $pdf->Cell(20,6,$row['stock'],1,0,'C'); 
    $pdf->Cell(20,6,$row['satuan'],1,0,'C'); 
    $pdf->Cell(20,6,$row['qty'],1,0,'C'); 
    $pdf->Cell(20,6,$row['satuanQty'],1,1,'C'); 

}

$pdf->Output();
?>