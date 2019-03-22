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
			<h1><u>Daftar User</u></h1>
			<?php
				if ($_SESSION['level']=='administrator') {
			?>
				<br><a class="btn btn-primary" role="button" href="pustaka.php?p=user&aksi=input">Tambah Data</a>
			<?php
				}
			?>

			<div class="table-responsive">
				<br>
				<table id="example" class="table table-bordered table-hover">
					<tr class="bg-info">
						<th>No</th>
						<th>ID User</th>
						<th>Username</th>
						<th>Password</th>
						<th>Level</th>
						<th>Aksi</th>
					</tr>

					<?php
						$ambil = mysql_query("SELECT * FROM user");
						$no=1;
						while($data = mysql_fetch_array($ambil)){
					?>

					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data['id_user']; ?></td>
						<td><?php echo $data['username']; ?></td>
						<td><?php echo $data['password']; ?></td>
						<td><?php echo $data['level']; ?></td>
						
						<td align="center">
							<a class="btn btn-info btn-sm" href="?p=user&aksi=edit&id_ubah=<?php echo $data['id_user']?>"><span data-feather="edit"></span></a> 
							<a class="btn btn-danger btn-sm" href="aksi_user.php?proses=hapus&id_hapus=<?php echo $data['id_user']?>" onclick="return confirm('Yakin akan menghapus data <?php echo $data['id_user']?>?')"><span data-feather="trash-2"></span></a>
						</td>
					</tr>
					<?php
						$no++;
						}
					?>
				</table>

				<!--<nav aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item">
							<a class="page-link" href="#" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item">
							<a class="page-link" href="#" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</nav>-->
			</div>
<?php
		break;
		case 'input' :
?>
			<h1>Entri User</h1>
			<form method="post" action="aksi_user.php?proses=entri">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Username</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" placeholder="Username" name="username" required>
					</div>
				</div>
							
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Password</label>
					<div class="col-sm-5">
						<input type="password" class="form-control" placeholder="Password" name="password" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Level</label>
					<div class="col-sm-5">
						<select class="form-control" name="level">
								<option value="administrator" checked>Administrator</option>
								<option value="anggota">Anggota</option>
						</select>
					</div>
				</div>
				
				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-5">
						<input class="btn btn-primary" type="submit" name="submit" value="Simpan">
						<input class="btn btn-primary" type="reset" name="reset" value="Reset">
						<a class="btn btn-primary" role="button" href="pustaka.php?p=user">Kembali</a>
					</div>
				</div>
			</form>

<?php
		break;
		case 'edit':

			include 'koneksi.php';

			$tampil=mysql_query("SELECT * FROM user where id_user='$_GET[id_ubah]'");
			$data=mysql_fetch_array($tampil);
?>
			<h1>Update User</h1>
			<form method="post" action="aksi_user.php?proses=ubah&id_ubah=<?php echo $data['id_user']?>">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">ID User</label>
					<div class="col-sm-5">
						<input class="form-control-plaintext" type="text" name="id_user" value="<?php echo $data['id_user']?>" readonly>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Username</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="username" value="<?php echo $data['username']?>">
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Password</label>
					<div class="col-sm-5">
						<input class="form-control" type="password" name="password"  value="<?php echo $data['password']?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Level</label>
					<div class="col-sm-5">
						<select class="form-control" name="level">
							<?php
								if ($data['level'] == 'administrator') {
							?>
								<option value="administrator" checked>Administrator</option>
								<option value="anggota">Anggota</option>
							<?php
								}
								else{
							?>
								<option value="anggota">Anggota</option>
								<option value="administrator">Administrator</option>
							<?php
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-5">
						<input class="btn btn-primary" type="submit" name="submit" value="Update">
						<a class="btn btn-primary" role="button" href="pustaka.php?p=user">Kembali</a>
					</div>
				</div>
			</form>
<?php
		break;
	}
?>