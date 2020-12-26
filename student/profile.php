<?php
require_once '../config/library.php';
require_once '../config/authentication.php';

$lib = new Library();
$auth = new Authentication();

if (!$auth->logged_std()) {
    header("Location: ../login/login.php");
}

$get_data = $auth->get_data_std();
$nilai = $lib->select_nilai($get_data['id_user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Special School Site</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Lingua project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">
			
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
								<div class="top_bar_phone"><span class="top_bar_title">Hallo! </span> <?= strtoupper($get_data['nama_user']); ?></div>
								<div class="top_bar_right ml-auto">

									<!-- Language -->
									<div class="top_bar_lang">
										<span class="top_bar_title">site language:</span>
										<ul class="lang_list">
											<li class="hassubs">
												<a href="#">Indonesia<i class="fa fa-angle-down" aria-hidden="true"></i></a>
												<ul>
													<li><a href="#">English</a></li>
												</ul>
											</li>
										</ul>
									</div>

									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</div>

		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo_container mr-auto">
								<a href="#">
									<div class="logo_text">Special School</div>
								</a>
							</div>
							<nav class="main_nav_contaner">
								<ul class="main_nav">
									<li ><a href="./index.php">Materi</a></li>
									<li class="active"><a href="./profile.php">Profil</a></li>
								</ul>
							</nav>
							<div class="header_content_right ml-auto text-right">

								<!-- Hamburger -->

								<div class="user"><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></div>
								<div class="hamburger menu_mm">
									<i class="fa fa-bars menu_mm" aria-hidden="true"></i>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</header>

	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="menu_mm"><a href="./index.php">Materi</a></li>
				<li class="menu_mm"><a href="./profile.php">Profil</a></li>				
				<li class="menu_mm"><a href="./logout.php">Logout</a></li>
			</ul>
		</nav>
	</div>
	
	<!-- Instructors -->

	<div class="instructors">
		<div class="instructors_background" style="background-image:url(images/instructors_background.png)"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<h2 class="section_title text-center">The Best Tutors in Town</h2>
				</div>
			</div>
			<div class="row instructors_row">

				

				<!-- Instructor -->
				<div class="col-lg-12 instructor_col">
					<div class="instructor text-center">
						<div class="instructor_image_container">
							<div class="instructor_image"><img src="images/instructor_2.jpg" alt=""></div>
						</div>
						<div class="instructor_name"><a href="#"><?php echo ucwords($get_data['nama_user']);?></a></div>
						<div class="instructor_title">Student</div>
						<div class="instructor_text">
							<figure>
								<blockquote class="blockquote">
									<p>"Pendidikan adalah senjata paling mematikan di dunia, karena dengan pendidikan, Anda dapat mengubah dunia."</p>
								</blockquote>
								<figcaption class="blockquote-footer">
									Nelson Mandela.
								</figcaption>
							</figure>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Register -->

	<div class="register">
		<div class="container">
			<div class="row">
				
				<!-- Register Form -->
			<div class="col-lg-2"></div>
				<div class="col-lg-8">
					<div class="register_form_container">
						<div class="register_form_title text-center" style="margin-bottom:10px;">History Nilai</div>
						<table class="table table-light" border="1">
							<thead>
								<th >Nama Tutorial</th>
								<th >Nilai</th>
								<th >Status</th>
							</thead>
							<?php
							while ($data = $nilai->fetch(PDO::FETCH_OBJ)) {?>
							<tr style="color:black;" <?php if($data->status == "FAILED"){echo "class='table-danger'";} ?>>
								<td><?=$data->nama_tutorial;?></td>
								<td><?=$data->nilai;?></td>
								<td><?=$data->status; ?></td>
							</tr>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	
		<!-- Footer -->

	<footer class="footer">
		<div class="footer_body">
			<div class="container">
				<div class="row">

					<!-- Newsletter -->
					<div class="col-lg-3 footer_col">
						<div class="newsletter_container d-flex flex-column align-items-start justify-content-end">
							<div class="footer_logo mb-auto"><a href="#">Special School</a></div>
							
						</div>
					</div>

					<!-- About -->
					<div class="col-lg-2 offset-lg-3 footer_col">
						<div>
							<div class="footer_title">About Us</div>
							<ul class="footer_list">
								<li><a href="#">Team</a></li>
								<li><a href="#">Contact us</a></li>
							</ul>
						</div>
					</div>

					<!-- Help & Support -->
					<div class="col-lg-2 footer_col">
						<div class="footer_title">Help & Support</div>
						<ul class="footer_list">
							<li><a href="#">Discussions</a></li>
							<li><a href="#">Troubleshooting</a></li>
						</ul>
					</div>

					<!-- Privacy -->
					<div class="col-lg-2 footer_col clearfix">
						<div>
							<div class="footer_title">Privacy & Terms</div>
							<ul class="footer_list">
								<li><a href="#">Terms</a></li>
								<li><a href="#">Privacy</a></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="copyright_content d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-start">
							<div class="cr"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
</body>
</html>