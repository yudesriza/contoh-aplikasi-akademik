<?php
include 'koneksi.php';
$page=(isset($_GET['p'])) ? $_GET['p'] : 'home';
	if ($page=='home') include ('home.php');
	if ($page=='user') include ('user.php');
	if ($page=='buku') include ('buku.php');
	if ($page=='pengarang') include ('pengarang.php');
	if ($page=='penerbit') include ('penerbit.php');
	if ($page=='anggota') include ('anggota.php');
	if ($page=='pinjam') include ('pinjam.php');
	if ($page=='logout') include ('logout.php');
?>