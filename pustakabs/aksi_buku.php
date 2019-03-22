<?php
	include 'koneksi.php';
	if($_GET['proses']=='entri'){
		if (isset($_POST['submit'])) {
			$simpan=mysql_query("INSERT INTO buku(judul_buku, id_pengarang, id_penerbit, tahun_terbit, no_isbn) VALUES ('$_POST[judul_buku]' ,'$_POST[pengarang]', '$_POST[penerbit]', '$_POST[tahun_terbit]', '$_POST[no_isbn]')");

			if ($simpan) {
				header('location:pustaka.php?p=buku');
			}
			else{
				echo "Gagal";
			}
		}
	}

	if($_GET['proses']=='ubah'){
		if (isset($_POST['submit'])) {
			$ubah=mysql_query("UPDATE buku set
							judul_buku = '$_POST[judul_buku]',
							id_pengarang = '$_POST[pengarang]',
							id_penerbit = '$_POST[penerbit]',
							tahun_terbit = '$_POST[tahun_terbit]',
							no_isbn = '$_POST[no_isbn]'
							where id_buku='$_GET[id_ubah]'
							");

			if ($ubah) {
				header('location:pustaka.php?p=buku');
			}
			else{
				echo "Gagal";
			}
		}
	}

	if($_GET['proses']=='hapus'){
		$hapus = mysql_query("DELETE FROM buku where id_buku='$_GET[id_hapus]'");
		if($hapus){
			header('location:pustaka.php?p=buku');
		}
	}
?>