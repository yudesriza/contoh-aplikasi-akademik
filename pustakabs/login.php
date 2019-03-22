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
	<link rel="stylesheet" type="text/css" href="css/cover.css">
</head>

<body class="text-center">
	<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  		<header class="masthead mb-auto">
	    	<div class="inner">
				
			</div>
		</header>

		<main role="main" class="inner cover">
			<h1 class="cover-heading">Selamat Datang</h1>
			<h2 class="cover-heading">Pustaka Balai Latihan Kerja Padang</h2>
			<br><br>

			<form class="form-signin" method="post">
				<h1 class="h3 mb-3 font-weight-normal">Log In</h1>
				
					<input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
				<br>
					<input type="password" class="form-control" name="password" placeholder="Password" required>
						
				
				<br><br>
				<input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Login">
				<p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
			</form>

			<?php
				if (isset($_POST['login'])) {
					include 'koneksi.php';
					$pass=md5($_POST['password']);
					$cek=mysql_query("SELECT * from user where username='$_POST[username]' and password='$pass'");

					$data=mysql_fetch_array($cek);

					$result=mysql_num_rows($cek);

					if($result==1){
						session_start();

						$_SESSION['user']=$data['username'];
						$_SESSION['level']=$data['level'];

						header('location:pustaka.php');
					}
					else{
						echo "<script>alert('Username atau Password anda SALAH')</script>";
					}
				}
			?>

		</main>

		<footer class="mastfoot mt-auto">
			<div class="inner">
				<p>Cover template for <a href="https://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
			</div>
		</footer>
	</div>
</body>
</html>