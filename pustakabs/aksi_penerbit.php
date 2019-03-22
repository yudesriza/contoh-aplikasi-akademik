<?php
	include 'koneksi.php';
	if($_GET['proses']=='entri'){
		if (isset($_POST['submit'])) {
			$simpan=mysql_query("INSERT INTO penerbit(nama_penerbit,email,no_telp,alamat) VALUES ('$_POST[nama_penerbit]' ,'$_POST[email]', '$_POST[no_telp]', '$_POST[alamat]')");

			if ($simpan) {
				header('location:pustaka.php?p=penerbit');
			}
			else{
				echo "Gagal";
			}
		}
	}

	if($_GET['proses']=='ubah'){
		if (isset($_POST['submit'])) {
			$ubah_data=mysql_query("UPDATE penerbit set
							nama_penerbit = '$_POST[nama_penerbit]',
							email = '$_POST[email]',
							no_telp = '$_POST[no_telp]',
							alamat = '$_POST[alamat]'
							where id_penerbit='$_GET[id_ubah]'
							");

			if ($ubah_data) {
				header('location:pustaka.php?p=penerbit');
			}
			else{
				echo "Gagal";
			}
		}
	}

	if($_GET['proses']=='hapus'){
		$hapus = mysql_query("DELETE FROM penerbit where id_penerbit='$_GET[id_hapus]'");
		if($hapus){
			header('location:pustaka.php?p=penerbit');
		}
	}
?>