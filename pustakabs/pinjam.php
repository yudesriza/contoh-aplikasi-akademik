<?php
	$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
	switch ($aksi) {
		case 'list' :
?>
			<h1><u>Daftar Peminjaman</u></h1>
			<?php
				if ($_SESSION['level']=='administrator') {
			?>
				<br><a class="btn btn-primary" role="button" href="pustaka.php?p=pinjam&aksi=input">Tambah Data</a>
			<?php
				}
			?>
			
			<div class="table-responsive">
				<br>
				<table id="example" class="table table-hover">
					<tr>
						<th>No</th>
						<th>ID Peminjaman</th>
						<th>Nama Anggota Pustaka</th>
						<th>Judul Buku</th>
						<th>Tanggal Pinjam</th>
						<th>Lama Peminjaman (Hari)</th>
						<th>Keterangan</th>
						<?php
							if ($_SESSION['level']=='administrator') {
								echo "<th>Aksi</th>";
							}
						?>
					</tr>

					<?php
						include 'koneksi.php';
						$tampil = mysql_query("SELECT peminjaman.id_pinjam, anggota.nama_anggota, buku.judul_buku, peminjaman.tgl_pinjam, peminjaman.lama, peminjaman.keterangan FROM ((peminjaman INNER JOIN anggota ON peminjaman.id_anggota=anggota.id_anggota) INNER JOIN buku ON peminjaman.id_buku=buku.id_buku)");
						$no=1;
						while($data = mysql_fetch_array($tampil)){
					?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $data['id_pinjam']; ?></td>
								<td><?php echo $data['nama_anggota']; ?></td>
								<td><?php echo $data['judul_buku']; ?></td>
								<td><?php echo $data['tgl_pinjam']; ?></td>
								<td><?php echo $data['lama']; ?></td>
								<td><?php echo $data['keterangan']; ?></td>
								<?php
									if ($_SESSION['level']=='administrator') {
								?>
										<td align="center">
											<a class="btn btn-info btn-sm" href="?p=pinjam&aksi=edit&id_ubah=<?php echo $data['id_pinjam']?>"><span data-feather="edit"></span></a> 
											<a class="btn btn-danger btn-sm" href="aksi_pinjam.php?proses=hapus&id_hapus=<?php echo $data['id_pinjam']?>" onclick="return confirm('Yakin akan menghapus data <?php echo $data['id_pinjam']?>?')"><span data-feather="trash-2"></span></a>
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
			<h1>Entri Peminjaman</h1>
			<form method="post" action="aksi_pinjam.php?proses=entri">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Anggota</label>
					<div class="col-sm-5">
						<select class="form-control" name="anggota">
							<?php
								include 'koneksi.php';
								$input = mysql_query("SELECT * FROM anggota");
								$no=1;
								while($data_input = mysql_fetch_array($input)){
									echo "<option value='$data_input[id_anggota]'>" . $data_input['nama_anggota'] . "</option>";
									$no++;
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Judul Buku</label>
					<div class="col-sm-5">
						<select class="form-control" name="buku">
							<?php
								include 'koneksi.php';
								$input = mysql_query("SELECT * FROM buku");
								$no=1;
								while($data_input = mysql_fetch_array($input)){
									echo "<option value='$data_input[id_buku]'>" . $data_input['judul_buku'] . "</option>";
									$no++;
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
					<div class="col-sm-5">
						<input class="form-control" type="date" placeholder="Tanggal Peminjaman"  name="tgl_pinjam" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Lama Peminjaman</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" placeholder="Lama Peminjaman"  name="lama" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Keterangan</label>
					<div class="col-sm-5">
						<textarea class="form-control" placeholder="Keterangan" name="keterangan" cols="25" rows="4"></textarea>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-5">
						<input class="btn btn-primary" type="submit" name="submit" value="Simpan">
						<input class="btn btn-primary" type="reset" name="reset" value="Reset">
						<a class="btn btn-primary" role="button" href="pustaka.php?p=pinjam">Kembali</a>
					</div>
				</div>
			</form>

<?php
		break;
		case 'edit':

			include 'koneksi.php';
			$tampil = mysql_query("SELECT peminjaman.id_pinjam,peminjaman.id_anggota, anggota.nama_anggota, peminjaman.id_buku, buku.judul_buku, peminjaman.tgl_pinjam, peminjaman.lama, peminjaman.keterangan FROM ((peminjaman INNER JOIN anggota ON peminjaman.id_anggota=anggota.id_anggota) INNER JOIN buku ON peminjaman.id_buku=buku.id_buku) where id_pinjam='$_GET[id_ubah]'");
			$data=mysql_fetch_array($tampil);
?>
			<h1>Update Data Buku</h1>
			<form method="post" action="aksi_pinjam.php?proses=ubah&id_ubah=<?php echo $data['id_pinjam']?>">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">ID Pinjam</label>
					<div class="col-sm-5">
						<input class="form-control-plaintext" type="text" name="id_pinjam" value="<?php echo $data['id_pinjam']?>" readonly>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Anggota</label>
					<div class="col-sm-5">
						<select class="form-control" name="anggota">
							<?php
								$tampil_anggota = mysql_query("SELECT * FROM anggota");
								$no=$data['id_anggota'];
								echo "<option value='$data[id_anggota]'>$data[nama_anggota]</option>";
									
								$count=1;
								while($data_anggota = mysql_fetch_array($tampil_anggota)){
									if($no==$data_anggota['id_anggota']) continue;
									else{
										echo "<option value='$data_anggota[id_anggota]'>$data_anggota[nama_anggota]</option>";
									}
									$count++;
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Judul Buku</label>
					<div class="col-sm-5">
						<select class="form-control" name="buku">
							<?php
								$tampil_buku = mysql_query("SELECT * FROM buku");
								$no=$data['id_buku'];
								echo "<option value='$data[id_buku]'>$data[judul_buku]</option>";
									
								$count=1;
								while($data_buku = mysql_fetch_array($tampil_buku)){
									if($no==$data_buku['id_buku']) continue;
									else{
										echo "<option value='$data_buku[id_buku]'>$data_buku[judul_buku]</option>";
										$count++;
									}
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
					<div class="col-sm-5">
						<input class="form-control" type="date" name="tgl_pinjam" value="<?php echo $data['tgl_pinjam']?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Lama Peminjaman (Hari)</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="lama" value="<?php echo $data['lama']?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Keterangan</label>
					<div class="col-sm-5">
						<textarea class="form-control" name="keterangan" cols="25" rows="4"><?php echo $data['keterangan']?></textarea>
					</div>
				</div>
								
				<div class="form-group row">
					<label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-5">
						<input class="btn btn-primary" type="submit" name="submit" value="Update">
						<a class="btn btn-primary" role="button" href="pustaka.php?p=pinjam">Kembali</a>
					</div>
				</div>
			</form>

<?php
		break;
	}
?>