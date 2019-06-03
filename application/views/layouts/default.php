<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<script src="/public/script/jquery.js"></script>
	<script src="/public/script/form.js"></script> 

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="/public/style/reset.css" rel="stylesheet"  type="text/css" media="screen" />	
	<link href="/public/style/user.css" rel="stylesheet"  type="text/css" media="screen" />	

	
</head>
<body>
<div class="containers">
	<!-- Верхняя часть страницы -->
	<header>
		<p class="name"> 
			Система мониторинга успеваемости студентов РТУ
		</p>
	</header>
	
	<!-- Основная часть страницы -->
	<?php echo $content; ?>
	
	<!-- Нижняя часть страницы -->
	<div class="footer">
	
	</div>
</div>

</body>
</html>