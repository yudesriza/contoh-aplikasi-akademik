<?php
	include 'koneksi.php';
	if($_GET['proses']=='entri'){
		if (isset($_POST['submit'])) {
			$simpan=mysql_query("INSERT INTO peminjaman(id_anggota, id_buku, tgl_pinjam, lama, keterangan) VALUES ('$_POST[anggota]' ,'$_POST[buku]', '$_POST[tgl_pinjam]', '$_POST[lama]', '$_POST[keterangan]')");

			if ($simpan) {
				header('location:pustaka.php?p=pinjam');
			}
			else{
				echo "Gagal";
			}
		}
	}

	if($_GET['proses']=='ubah'){
		if (isset($_POST['submit'])) {
			$ubah=mysql_query("UPDATE peminjaman set
							id_anggota = '$_POST[anggota]',
							id_buku = '$_POST[buku]',
							tgl_pinjam = '$_POST[tgl_pinjam]',
							lama = '$_POST[lama]',
							keterangan = '$_POST[keterangan]'
							where id_pinjam='$_GET[id_ubah]'
							");

			if ($ubah) {
				header('location:pustaka.php?p=pinjam');
			}
			else{
				echo "Gagal";
			}
		}
	}

	if($_GET['proses']=='hapus'){
		$hapus = mysql_query("DELETE FROM peminjaman where id_pinjam='$_GET[id_hapus]'");
		if($hapus){
			header('location:pustaka.php?p=pinjam');
		}
	}
?>