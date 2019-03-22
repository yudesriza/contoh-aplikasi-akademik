<?php
	include 'koneksi.php';
	if($_GET['proses']=='entri'){
		if (isset($_POST['submit'])) {
			$simpan=mysql_query("INSERT INTO anggota(nama_anggota,email,jekel,no_telp,alamat) VALUES ('$_POST[nama_anggota]' ,'$_POST[email]', '$_POST[jekel]', '$_POST[no_telp]', '$_POST[alamat]')");

			if ($simpan) {
				header('location:pustaka.php?p=anggota');
			}
			else{
				echo "Gagal";
			}
		}
	}

	if($_GET['proses']=='ubah'){
		if (isset($_POST['submit'])) {
			$ubah_data=mysql_query("UPDATE anggota set
							nama_anggota = '$_POST[nama_anggota]',
							email = '$_POST[email]',
							jekel = '$_POST[jekel]',
							no_telp = '$_POST[no_telp]',
							alamat = '$_POST[alamat]'
							where id_anggota='$_GET[id_ubah]'
							");

			if ($ubah_data) {
				header('location:pustaka.php?p=anggota');
			}
			else{
				echo "Gagal";
			}
		}
	}

	if($_GET['proses']=='hapus'){
		$hapus = mysql_query("DELETE FROM anggota where id_anggota='$_GET[id_hapus]'");
		if($hapus){
			header('location:pustaka.php?p=anggota');
		}
	}
?>