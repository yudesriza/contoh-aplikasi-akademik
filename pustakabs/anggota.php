<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Jekyll v3.8.5">

	<title>Pustaka BLK Padang</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<?php
	$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
	switch ($aksi) {
		case 'list' :
?>
			<h1 class="cover-heading"><u>Daftar Anggota Pustaka</u></h1>
			<?php
				if ($_SESSION['level']=='administrator') {
			?>
				<br><a class="btn btn-primary" role="button" href="pustaka.php?p=anggota&aksi=input">Tambah Data</a>
			<?php
				}
			?>

			<div class="table-responsive">
				<br>
				<table id="example" class="table table-hover">
					<tr>
						<th>No</th>
						<th>ID Anggota</th>
						<th>Nama Anggota</th>
						<th>Email</th>
						<th>Jenis Kelamin</th>
						<th>No Telepon</th>
						<th>Alamat</th>
						<?php
							if ($_SESSION['level']=='administrator') {
								echo "<th>Aksi</th>";
							}
						?>
					</tr>

					<?php
						include 'koneksi.php';

						$ambil = mysql_query("SELECT * FROM anggota");
						$no=1;
						while($data = mysql_fetch_array($ambil)){
					?>

					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data['id_anggota']; ?></td>
						<td><?php echo $data['nama_anggota']; ?></td>
						<td><?php echo $data['email']; ?></td>
						<td><?php echo $data['jekel']; ?></td>
						<td><?php echo $data['no_telp']; ?></td>
						<td><?php echo $data['alamat']; ?></td>
						<?php
							if ($_SESSION['level']=='administrator') {
						?>
								<td align="center">
									<a class="btn btn-info btn-sm" href="?p=anggota&aksi=edit&id_ubah=<?php echo $data['id_anggota']?>"><span data-feather="edit"></span></a> 
									<a class="btn btn-danger btn-sm" href="aksi_anggota.php?proses=hapus&id_hapus=<?php echo $data['id_anggota']?>" onclick="return confirm('Yakin akan menghapus data <?php echo $data['id_anggota']?>?')"><span data-feather="trash-2"></span></a>
								</td>
						<?php
							}
						?>
					</tr>
					<?php
						$no++;
						}
					?>
				</table>

<?php
		break;
		case 'input' :
?>
			<h1>Entri Data Anggota Pustaka</h1>
			<form method="post" action="aksi_anggota.php?proses=entri">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Nama Anggota</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" placeholder="Nama Anggota"  name="nama_anggota" required>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-5">
						<input class="form-control" type="email" placeholder="Email"  name="email" required>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="jekel" value="L" checked>
							<label class="form-check-label">Laki-laki</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="jekel" value="P">
							<label class="form-check-label">Perempuan</label>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">No Telepon</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" placeholder="No Telepon"  name="no_telp" required>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Alamat</label>
					<div class="col-sm-5">
						<textarea class="form-control" placeholder="Alamat" name="alamat" cols="25" rows="4"></textarea>
					</div>
				</div>
					
				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-5">
						<input class="btn btn-primary" type="submit" name="submit" value="Simpan">
						<input class="btn btn-primary" type="reset" name="reset" value="Reset">
						<a class="btn btn-primary" role="button" href="pustaka.php?p=anggota">Kembali</a>
					</div>
				</div>
			</form>

<?php
		break;
		case 'edit':

			include 'koneksi.php';

			$tampil=mysql_query("SELECT * FROM anggota where id_anggota='$_GET[id_ubah]'");
			$data=mysql_fetch_array($tampil);
?>
			<h1>Update Data Anggota Pustaka</h1>
			<form method="post" action="aksi_anggota.php?proses=ubah&id_ubah=<?php echo $data['id_anggota']?>">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">ID Anggota</label>
					<div class="col-sm-5">
						<input class="form-control-plaintext" type="text" name="id_anggota" value="<?php echo $data['id_anggota']?>" readonly>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Nama Anggota</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="nama_anggota" value="<?php echo $data['nama_anggota']?>">
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-5">
						<input class="form-control" type="email" name="email" value="<?php echo $data['email']?>">
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
					<?php
						if ($data['jekel'] == 'L') {
					?>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="jekel" value="L" checked>
									<label class="form-check-label">Laki-laki</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="jekel" value="P">
									<label class="form-check-label">Perempuan</label>
							</div>
					<?php
						}
						else{
					?>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="jekel" value="L">
									<label class="form-check-label">Laki-laki</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="jekel" value="P" checked>
									<label class="form-check-label">Perempuan</label>
							</div>
					<?php
						}
					?>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">No Telepon</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="no_telp" value="<?php echo $data['no_telp']?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Alamat</label>
					<div class="col-sm-5">
						<textarea class="form-control" placeholder="Alamat" name="alamat" cols="25" rows="4"><?php echo $data['alamat']?></textarea>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-5">
						<input class="btn btn-primary" type="submit" name="submit" value="Update">
						<a class="btn btn-primary" role="button" href="pustaka.php?p=anggota">Kembali</a>
					</div>
				</div>
			</form>

<?php
		break;
	}
?>