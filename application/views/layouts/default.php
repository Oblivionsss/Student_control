<!DOCTYPE html>
<html class="mheight ">
<head>
	<title><?php echo $title; ?></title>

	<link href="/public/style/reset.css" rel="stylesheet"  type="text/css" media="screen" />	
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
	<link href="/public/style/main/main-style.css" rel="stylesheet"  type="text/css" media="screen" />	
	
	<script src="/public/script/jquery.js"></script>
	<script src="/public/script/form.js"></script>
	
</head> 
<body class=" h-100">

	<div class="container-fluid d-flex flex-column  h-100">
		<?php echo $content; ?>
		<!-- Footer -->
		<footer class="blog-footer py-3 mt-auto">

			<!-- Footer Links -->
			<div class="container text-center text-md-left">

				<!-- Grid row -->
				<div class="row">

				
					<!-- Grid column -->
					<div class="col-auto mx-auto">

						<ul class="list-unstyled">
							<li>
							<a href="https://www.mirea.ru/">Российский технологический университет</a>
							</li>
							<li>
							<a href="https://it.mirea.ru/">Институт информационных технологий</a>
							</li>
						</ul>

					</div>
					<!-- Grid column -->

					<hr class="clearfix w-100 d-md-none">

					<!-- Grid column -->
					<div class="col-auto mx-auto">

						<ul class="list-unstyled">
							<li>
							<a href="https://github.com/Oblivionsss/student_control">GitHub Profile</a>
							</li>
							<li>
							<a href="https://www.instagram.com/uvolen.alexandr/">Инстаграмм</a>
							</li>
						</ul>

					</div>
					<!-- Grid column -->
					<hr class="clearfix w-100 d-md-none">

				</div>
				<!-- Grid row -->

			</div>
			<!-- Footer Links -->

			<div class="row">
				<!-- Copyright -->
				<div class="col-md-7 mx-auto">
					Page built with
					<a href="https://bootstrap-4">Boostrap</a>
					&
					<a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>
				</div>
				<!-- Copyright -->

			</div>

		</footer>
		<!-- Footer -->
	</div>
	<!-- end container-fluid -->

</body>
</html>