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
					<a href="/user/rasp">Расписание</a>
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

		<div class="content-inner">
            <form class="" method="post" action="">

            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Имя</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="name" value="<?=$user[0]['Name']?>" placeholder="Введите Ваше имя"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Фамилия</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="name" value="<?=$user[0]['Surname']?>" placeholder="Введите Ваше имя"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Отчество</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="name" value="<?=$user[0]['Matern']?>" placeholder="Введите Ваше имя"/>
                    </div>
                </div>
            </div>

            <div class="input_block">
                <div class="cols-sm-10 float-left">
                        <label for="username" class="cols-sm-2 control-label">Год рождения</label>
                    <div class="input-group">
                        <span class="input-group-addon input-group-half"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                        <input type="date" class="form-control" value="{<?=$user[0]['DateOfBirth']?>}" name="dateOfBirth"/>
                    </div>
                </div>
            </div>

        </div>
        
	</div>


	<div class="footer">
	
	</div>

</div>