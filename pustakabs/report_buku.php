<?php
require('fpdf.php');

$pdf = new FPDF();
$pdf -> AddPage();	//membuat halaman baru
$pdf->SetFont('Arial','B',16);

//MENCETAK STRING
$pdf -> Cell(190,7,'PERPUSTAKAAN DAERAH PADANG',0,1,'C');
$pdf -> SetFont('Arial', 'B', 12);
$pdf-> Cell(190,7,'DAFTAR BUKU',0,1,'C');

//memberikan space ke bawah agar tidak terlalu rapat
$pdf-> Cell(10,7,'',0,1);

//tabel heading
$pdf -> SetFont('Arial','B',10);
$pdf -> Cell(10,6,'NO',1,0,'C');
$pdf -> Cell(70,6,'JUDUL BUKU',1,0,'C');
$pdf -> Cell(25,6,'PENGARANG',1,0,'C');
$pdf -> Cell(25,6,'PENERBIT',1,0,'C');
$pdf -> Cell(30,6,'TAHUN',1,0,'C');
$pdf -> Cell(30,6,'NO ISBN',1,1,'C');
$pdf -> SetFont('Arial','',10);

include 'koneksi.php';
$list_buku = mysql_query("SELECT * FROM buku, pengarang, penerbit WHERE buku.id_pengarang=pengarang.id_pengarang AND buku.id_penerbit=penerbit.id_penerbit");
$no=1;
while ($row=mysql_fetch_array($list_buku)) {
	$pdf -> Cell(10,6,$no,1,0);
	$pdf -> Cell(70,6,$row['judul_buku'],1,0);
	$pdf -> Cell(25,6,$row['nama_pengarang'],1,0);
	$pdf -> Cell(25,6,$row['nama_penerbit'],1,0);
	$pdf -> Cell(30,6,$row['tahun_terbit'],1,0);
	$pdf -> Cell(30,6,$row['no_isbn'],1,1);
	$no++;
}
$pdf ->Output();
?>