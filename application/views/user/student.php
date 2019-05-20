<link href="/public/style/reset.css" rel="stylesheet"  type="text/css" media="screen" />	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<link href="/public/style/user.css" rel="stylesheet"  type="text/css" media="screen" />	
	
<div class="container">

	<header>
		<div class="logo">
			Image
		</div>

		<div class="user">
			<?php echo $user[0]['Name'] . " " . $user[0]['Matern']?>
		</div>
		
		<div class="logout">
			<a href="../application/core/Logout.php">Выход</a>
		</div>
	</header>


	<div class="content">

		<div class="menu">
			<div class="container-menu">
                
                <div class="menu-link">
					<a href="/user">Расписание</a>
				</div>

				<div class="menu-link">
					<a href="/user/student">Студенты</a>
				</div>

				<div class="menu-link">
					<a href="/user/create">Редактор</a>
                </div>
                
                <div class="menu-link">
					<a href="/user/setting">Настройки</a>
                </div>
                
			</div>
		</div>

		<div class="add">

		</div>
	</div>


	<div class="footer">
	
	</div>

</div>