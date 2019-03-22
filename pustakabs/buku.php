<?php
	$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
	switch ($aksi) {
		case 'list' :
?>
			<h1><u>Daftar Buku</u></h1>
			<?php
				if ($_SESSION['level']=='administrator') {
			?>
				<br><a class="btn btn-primary" role="button" href="pustaka.php?p=buku&aksi=input">Tambah Data</a>
			<?php
				}
			?>
			<a class="btn btn-primary" role="button" href="report_buku.php">Cetak Buku</a>
			<div class="table-responsive">
				<br>
				<table id="example" class="table table-hover">
					<thead>
					<tr>
						<th>No</th>
						<th>ID Buku</th>
						<th>Judul Buku</th>
						<th>Pengarang</th>
						<th>Penerbit</th>
						<th>Tahun Terbit</th>
						<th>No ISBN</th>
						<?php
							if ($_SESSION['level']=='administrator') {
								echo "<th>Aksi</th>";
							}
						?>
					</tr>
					</thead>
					<tbody>
					<?php
						include 'koneksi.php';

						$tampil = mysql_query("SELECT buku.id_buku, buku.judul_buku, pengarang.nama_pengarang, penerbit.nama_penerbit, buku.tahun_terbit, buku.no_isbn FROM ((buku INNER JOIN pengarang ON buku.id_pengarang=pengarang.id_pengarang) INNER JOIN penerbit ON buku.id_penerbit=penerbit.id_penerbit)");
						$no=1;
						while($data = mysql_fetch_array($tampil)){
					?>

					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data[0]; ?></td>
						<td><?php echo $data[1]; ?></td>
						<td><?php echo $data[2]; ?></td>
						<td><?php echo $data[3]; ?></td>
						<td><?php echo $data[4]; ?></td>
						<td><?php echo $data[5]; ?></td>
						<?php
							if ($_SESSION['level']=='administrator') {
						?>
								<td align="center">
									<a class="btn btn-info btn-sm" href="?p=buku&aksi=edit&id_ubah=<?php echo $data['0']?>"><span data-feather="edit"></span></a> 
									<a class="btn btn-danger btn-sm" href="aksi_buku.php?proses=hapus&id_hapus=<?php echo $data['0']?>" onclick="return confirm('Yakin akan menghapus data <?php echo $data['0']?>?')"><span data-feather="trash-2"></span></a>
								</td>
						<?php
							}
						?>
					</tr>
					<?php
							$no++;
						}
					?>
					</tbody>
				</table>
			</div>

<?php
		break;
		case 'input' :
?>
			<h1>Entri Data Buku</h1>
			<form method="post" action="aksi_buku.php?proses=entri">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Judul Buku</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" placeholder="Judul Buku"  name="judul_buku" required>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Pengarang</label>
					<div class="col-sm-5">
						<select class="form-control" name="pengarang">
							<?php
								include 'koneksi.php';
								$input = mysql_query("SELECT * FROM pengarang");
								$no=1;
								while($data_input = mysql_fetch_array($input)){
									echo "<option value='$data_input[id_pengarang]'>" . $data_input['nama_pengarang'] . "</option>";
									$no++;
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Penerbit</label>
					<div class="col-sm-5">
						<select class="form-control" name="penerbit">
							<?php
								include 'koneksi.php';
								$input = mysql_query("SELECT * FROM penerbit");
								$no=1;
								while($data_input = mysql_fetch_array($input)){
									echo "<option value='$data_input[id_penerbit]'>" . $data_input['nama_penerbit'] . "</option>";
									$no++;
								}
							?>
						</select>
					</div>
				</div>
					
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Tahun Terbit</label>
					<div class="col-sm-5">
						<select class="form-control" name="tahun_terbit">
							<?php
								for ($i=1961; $i <=date('Y') ; $i++) { 
									echo "<option value='$i'>$i</option>";
								}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">No ISBN</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" placeholder="No ISBN"  name="no_isbn" required>
					</div>
				</div>
				
				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-5">
						<input class="btn btn-primary" type="submit" name="submit" value="Simpan">
						<input class="btn btn-primary" type="reset" name="reset" value="Reset">
						<a class="btn btn-primary" role="button" href="pustaka.php?p=buku">Kembali</a>
					</div>
				</div>
			</form>

<?php
		break;
		case 'edit':

			include 'koneksi.php';
			$tampil=mysql_query("SELECT buku.id_buku, buku.judul_buku, buku.id_pengarang, pengarang.nama_pengarang, buku.id_penerbit, penerbit.nama_penerbit, buku.tahun_terbit, buku.no_isbn from ((buku INNER JOIN pengarang ON buku.id_pengarang=pengarang.id_pengarang) INNER JOIN penerbit ON buku.id_penerbit=penerbit.id_penerbit) where id_buku='$_GET[id_ubah]'");
			$data=mysql_fetch_array($tampil);
?>
			<h1>Update Data Buku</h1>
			<form method="post" action="aksi_buku.php?proses=ubah&id_ubah=<?php echo $data['id_buku']?>">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">ID Buku</label>
					<div class="col-sm-5">
						<input class="form-control-plaintext" type="text" name="id_buku" value="<?php echo $data['id_buku']?>" readonly>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Judul Buku</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="judul_buku" value="<?php echo $data['judul_buku']?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Pengarang</label>
					<div class="col-sm-5">
						<select class="form-control" name="pengarang">
							<?php
								$tampil_pengarang = mysql_query("SELECT * FROM pengarang");
								$no=$data['id_pengarang'];
								echo "<option value='$data[id_pengarang]'>$data[nama_pengarang]</option>";
									
								$count=1;
								while($data_pengarang = mysql_fetch_array($tampil_pengarang)){
									if($no==$data_pengarang['id_pengarang']) continue;
									else{
										echo "<option value='$data_pengarang[id_pengarang]'>$data_pengarang[nama_pengarang]</option>";
											
									}
									$count++;
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Penerbit</label>
					<div class="col-sm-5">
						<select class="form-control" name="penerbit">
							<?php
								$tampil_penerbit = mysql_query("SELECT * FROM penerbit");
								$no=$data['id_penerbit'];
								echo "<option value='$data[id_penerbit]'>$data[nama_penerbit]</option>";
									
								$count=1;
								while($data_penerbit = mysql_fetch_array($tampil_penerbit)){
									if($no==$data_penerbit['id_penerbit']) continue;
									else{
										echo "<option value='$data_penerbit[id_penerbit]'>$data_penerbit[nama_penerbit]</option>";
										$count++;
									}
								}
							?>
						</select>
					</div>
				</div>
					
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Tahun Terbit</label>
					<div class="col-sm-5">
						<select class="form-control" name="tahun_terbit">
							<?php
								echo "<option value='$data[tahun_terbit]'>$data[tahun_terbit]</option>";
								for ($i=1961; $i <=date('Y') ; $i++) { 
									echo "<option value='$i'>$i</option>";
								}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">No ISBN</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="no_isbn" value="<?php echo $data['no_isbn']?>">
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-5">
						<input class="btn btn-primary" type="submit" name="submit" value="Update">
						<a class="btn btn-primary" role="button" href="pustaka.php?p=buku">Kembali</a>
					</div>
				</div>
			</form>

<?php
		break;
	}
?>