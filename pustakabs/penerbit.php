<?php
	$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
	switch ($aksi) {
		case 'list' :
?>
			<h1><u>Daftar Penerbit</u></h1>
			<?php
				if ($_SESSION['level']=='administrator') {
			?>
				<br><a class="btn btn-primary" role="button" href="pustaka.php?p=penerbit&aksi=input">Tambah Data</a>
			<?php
				}
			?>
			<div class="table-responsive">
				<br>
				<table id="example" class="table table-hover">
					<tr>
						<th>No</th>
						<th>ID Penerbit</th>
						<th>Nama Penerbit</th>
						<th>Email</th>
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

						$ambil = mysql_query("SELECT * FROM penerbit");
						$no=1;
						while($data = mysql_fetch_array($ambil)){
					?>

							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $data['id_penerbit']; ?></td>
								<td><?php echo $data['nama_penerbit']; ?></td>
								<td><?php echo $data['email']; ?></td>
								<td><?php echo $data['no_telp']; ?></td>
								<td><?php echo $data['alamat']; ?></td>
								<?php
									if ($_SESSION['level']=='administrator') {
								?>
										<td align="center">
											<a class="btn btn-info btn-sm" href="?p=penerbit&aksi=edit&id_ubah=<?php echo $data['id_penerbit']?>"><span data-feather="edit"></span></a> 
											<a class="btn btn-danger btn-sm" href="aksi_penerbit.php?proses=hapus&id_hapus=<?php echo $data['id_penerbit']?>" onclick="return confirm('Yakin akan menghapus data <?php echo $data['id_penerbit']?>?')"><span data-feather="trash-2"></span></a>
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
			</div>

<?php
		break;
		case 'input' :
?>
			<h1>Entri Data Penerbit</h1>
			<form method="post" action="aksi_penerbit.php?proses=entri">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Nama Penerbit</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" placeholder="Nama Penerbit" name="nama_penerbit" required>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-5">
						<input class="form-control" type="email" placeholder="Email"  name="email" required>
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
						<a class="btn btn-primary" role="button" href="pustaka.php?p=penerbit">Kembali</a>
					</div>
				</div>
			</form>

<?php
		break;
		case 'edit':

			include 'koneksi.php';

			$tampil=mysql_query("SELECT * FROM penerbit where id_penerbit='$_GET[id_ubah]'");
			$data=mysql_fetch_array($tampil);
?>
			<h1>Update Data Penerbit</h1>
			<form method="post" action="aksi_penerbit.php?proses=ubah&id_ubah=<?php echo $data['id_penerbit']?>">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">ID Penerbit</label>
					<div class="col-sm-5">
						<input class="form-control-plaintext" type="text" name="id_penerbit" value="<?php echo $data['id_penerbit']?>" readonly>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Nama Penerbit</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="nama_penerbit"  value="<?php echo $data['nama_penerbit']?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-5">
						<input class="form-control" type="email" name="email" value="<?php echo $data['email']?>">
					</div>
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
						<a class="btn btn-primary" role="button" href="pustaka.php?p=penerbit">Kembali</a>
					</div>
				</div>
			</form>

<?php
		break;
	}
?>