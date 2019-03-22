<?php
	include 'koneksi.php';
	if($_GET['proses']=='entri'){
		if (isset($_POST['submit'])) {
			$simpan=mysql_query("INSERT INTO pengarang(nama_pengarang,email,jekel,no_telp,alamat) VALUES ('$_POST[nama_pengarang]' ,'$_POST[email]', '$_POST[jekel]', '$_POST[no_telp]', '$_POST[alamat]')");

			if ($simpan) {
				header('location:pustaka.php?p=pengarang');
			}
			else{
				echo "Gagal";
			}
		}
	}

	if($_GET['proses']=='ubah'){
		if (isset($_POST['submit'])) {
			$ubah_data=mysql_query("UPDATE pengarang set
							nama_pengarang = '$_POST[nama_pengarang]',
							email = '$_POST[email]',
							jekel = '$_POST[jekel]',
							no_telp = '$_POST[no_telp]',
							alamat = '$_POST[alamat]'
							where id_pengarang='$_GET[id_ubah]'
							");

			if ($ubah_data) {
				header('location:pustaka.php?p=pengarang');
			}
			else{
				echo "Gagal";
			}
		}
	}

	if($_GET['proses']=='hapus'){
		$hapus = mysql_query("DELETE FROM pengarang where id_pengarang='$_GET[id_hapus]'");
		if($hapus){
			header('location:pustaka.php?p=pengarang');
		}
	}
?>