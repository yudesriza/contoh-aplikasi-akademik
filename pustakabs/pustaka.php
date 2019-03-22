<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Jekyll v3.8.5">

	<title>Pustaka BLK Padang</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/navbartop-fixed.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
</head>

<body>

	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand" href="#">Pustaka BLK Padang</a>
		
	</nav>

	
	<nav class="navbar navbar-expand-sm navbar-light bg-secondary sticky-top">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<?php
					session_start();
					if(isset($_SESSION['user'])){
						if ($_SESSION['level']=='administrator') {					
				?>
							<li class="nav-item active">
								<a class="nav-link" href="pustaka.php?p=home">Home <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item  active">
								<a class="nav-link" href="pustaka.php?p=user">User</a>
							</li>
							<li class="nav-item  active">
								<a class="nav-link" href="pustaka.php?p=anggota">Anggota</a>
							</li>
							<li class="nav-item  active">
								<a class="nav-link" href="pustaka.php?p=buku">Buku</a>
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="pustaka.php?p=pengarang">Pengarang</a>
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="pustaka.php?p=penerbit">Penerbit</a>
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="pustaka.php?p=pinjam">Peminjaman</a>
							</li>
				<?php
						}
						elseif ($_SESSION['level']=='anggota') {
				?>
							<li class="nav-item active">
								<a class="nav-link" href="pustaka.php?p=anggota">Anggota</a>
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="pustaka.php?p=buku">Buku</a>
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="pustaka.php?p=pengarang">Pengarang</a>
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="pustaka.php?p=penerbit">Penerbit</a>
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="pustaka.php?p=pinjam">Peminjaman</a>
							</li>
							
				<?php
						}
					}
				?>
			</ul>
			<!--<form class="form-inline mt-2 mt-md-0">
				<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-light" type="submit"><span data-feather="search"></span></button>
			</form>
			<div class="dropdown">
				<button class="btn btn-outline-light dropdown-toggle" type="button" data-toggle="dropdown">
					<span class="caret">Akun</span>
				</button>
				<li><span>Hai</span></li>
				<li><a href="logout.php"><span data-feather="log-out"></span></a></li>
			</div>-->

			
		</div>
		<div class="dropdown">
			<button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php 
					
					if(isset($_SESSION['user'])) echo $_SESSION['level']?>
			</button>
			<div class="dropdown-menu mr-auto" aria-labelledby="dropdownMenuButton">
				<span>Hai,<?php echo $_SESSION['user']?></span>
				<a class="dropdown-item" href="pustaka.php?p=logout"><span data-feather="log-out"></span></a>
			</div>
		</div>
	</nav>

	<main role="main" class="container">
		<?php
			include 'main.php';
		?>
	</main>

	<nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark">
		<span class="navbar-brand">Copyright &copy; YRiza2019</span>
	</nav>

	<script src="js/feather.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-3.3.1.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>

	<script>
		$(document).ready(function(){
			$(".dropdown-toogle").dropdown();
		});
		feather.replace();

		$(document).ready(function(){
		$('#example').DataTable();
		});
	</script>

</body>
</html>