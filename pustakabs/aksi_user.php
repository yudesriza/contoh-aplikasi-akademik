<?php
	include 'koneksi.php';
	if($_GET['proses']=='entri'){
		if (isset($_POST['submit'])) {
			$pass=md5($_POST['password']);
			$simpan = mysql_query("INSERT INTO user(username, password, level) VALUES ('$_POST[username]', '$pass', '$_POST[level]')");

			if ($simpan) {
				header('location:pustaka.php?p=user');
			}
			else{
				echo "Gagal Disimpan";
			}
		}
	}

	if($_GET['proses']=='ubah'){
		if (isset($_POST['submit'])) {
			$pass=md5($_POST['password']);
			$ubah=mysql_query("UPDATE user set
							id_user = '$_POST[id_user]',
							username = '$_POST[username]',
							password = '$pass',
							level = '$_POST[level]'
							where id_user='$_GET[id_ubah]'
							");

			if ($ubah) {
				header('location:pustaka.php?p=user');
			}
			else{
				echo "Gagal";
			}
		}
	}

	if($_GET['proses']=='hapus'){
		$hapus = mysql_query("DELETE FROM user where id_user='$_GET[id_hapus]'");

		if($hapus){
			header('location:pustaka.php?p=user');
		}
	}
?>