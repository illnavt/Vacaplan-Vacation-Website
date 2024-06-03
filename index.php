<?php
require "kode.php";
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Traveler &mdash; Samarinda State Polytechnic</title>
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			// Menangkap klik pada tautan "About Us"
			document.querySelector('a[href="#about"]').addEventListener("click", function (event) {
				event.preventDefault(); // Mencegah perilaku default dari tautan
				// Menggulir ke elemen dengan ID yang dituju
				document.getElementById('gtco-features').scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				});
			});
		});

		document.addEventListener("DOMContentLoaded", function () {
			const scheduleButtons = document.querySelectorAll('.scheduleButton');

			scheduleButtons.forEach(button => {
				button.addEventListener('click', function () {
					// Mengarahkan ke URL yang disimpan di dalam atribut data-url
					const url = this.getAttribute('data-url');
					window.location.href = url;
				});
			});
		});
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by GetTemplates.co" />
	<meta name="keywords"
		content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="GetTemplates.co" />

	<meta property="og:title" content="" />
	<meta property="og:image" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:description" content="" />
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" href="images/logo.png">

	<script src="js/modernizr-2.6.2.min.js"></script>
	<script src="js/respond.min.js"></script>
</head>

<body>

	<div class="gtco-loader"></div>
	<div id="page">
		<div class="page-inner">
			<nav class="gtco-nav" role="navigation">
				<div class="gtco-container">
					<div class="row">
						<div class="col-sm-4 col-xs-12">
							<?php
							if (isset($_SESSION['session_username'])) {
								echo '<div id="gtco-logo"><a href="booking.php">Vacaplan <em>.</em></a></div>';
							} else {
								echo '<div id="gtco-logo"><a href="index.php">Vacaplan <em>.</em></a></div>';
							}
							?>

						</div>
						<div class="col-xs-8 text-right menu-1">
							<ul>
								<?php
								if (isset($_SESSION['session_username'])) {
									// Jika sudah login, tampilkan teks "Profile" dan dropdown dengan nama pengguna
									$username = $_SESSION['session_username'];
									echo '<li><a href="booking.php">Book Now</a></li>';
								} else {
									// Jika belum login, tampilkan teks "Login"
									echo '<li><a href="login.php">Book Now</a></li>';
								}
								?>
								<!-- <li class="has-dropdown">
									<a href="#">Transport</a>
									<ul class="dropdown">
										<li><a href="../ininyoba/transport.php">Plane</a></li>
										<li><a href="../ininyoba/transport.php">Train</a></li>
										<li><a href="../ininyoba/transport.php">Ship</a></li>
										<li><a href="../ininyoba/transport.php">Bus</a></li>
										<li><a href="../ininyoba/transport.php">Car</a></li>
									</ul>
								</li> -->
								<li><a href="#about">About Us</a></li>
								<?php
								if (isset($_SESSION['session_username'])) {
									// Jika sudah login, tampilkan teks "Profile" dan dropdown dengan nama pengguna
									$username = $_SESSION['session_username'];
									echo '<li class="has-dropdown">
                							<a href="#">Profile</a>
                							<ul class="dropdown">
                    							<li align="center">' . $username . '</li>
                    							<li align="center"><a href="logout.php">Logout</a></li>
               					 			</ul>
            							</li>';
								} else {
									// Jika belum login, tampilkan teks "Login"
									echo '<li><a href="login.php">Login</a></li>';
								}
								?>
							</ul>

						</div>
					</div>
				</div>
			</nav>
			<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner"
				style="background-image: url(images/pesawat.jpg)">
				<div class="overlay"></div>
				<div class="gtco-container">
					<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
						<h1>Planing Trip To Anywhere in Indonesia?</h1>
					</div>
				</div>
			</header>

			<div id="gtco-features">
				<div class="gtco-container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
							<h2>About Us</h2>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora dolorem provident amet
								odit odio inventore officiis atque, ratione quos neque, dignissimos quia reprehenderit
								consequatur voluptatem architecto adipisci ad obcaecati fugiat.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<div class="feature-center animate-box" data-animate-effect="fadeIn">
								<span class="icon">
									<i>1</i>
								</span>
								<h3>Lorem ipsum dolor sit amet</h3>
								<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem
									provident. Odit ab aliquam dolor eius.</p>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="feature-center animate-box" data-animate-effect="fadeIn">
								<span class="icon">
									<i>2</i>
								</span>
								<h3>Consectetur adipisicing elit</h3>
								<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem
									provident. Odit ab aliquam dolor eius.</p>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="feature-center animate-box" data-animate-effect="fadeIn">
								<span class="icon">
									<i>3</i>
								</span>
								<h3>Dignissimos asperiores vitae</h3>
								<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem
									provident. Odit ab aliquam dolor eius.</p>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="gtco-container">
				<div class="row copyright">
					<div class="col-md-12">
						<p class="pull-left">
							<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small>
							<small class="block">Designed by <a href="" target="_blank">Kelompok 1</a> Template: <a
									href="" target="_blank">Traveler</a></small>
						</p>
						<p class="pull-right">
						<ul class="gtco-social-icons pull-right">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
						</p>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.countTo.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<script src="js/main.js"></script>
	<!-- <script src="js/bootstrap-datepicker.min.js"></script> -->
</body>

</html>