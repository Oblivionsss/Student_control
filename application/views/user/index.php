<link href="/public/style/reset.css" rel="stylesheet"  type="text/css" media="screen" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />		
<link href="/public/style/user.css" rel="stylesheet"  type="text/css" media="screen" />	
	
<script src="/public/script/addDate.js"></script> 
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

		<div>
			
			
			<div class="block_input">
				
				<form action="#" method="post" id="add">
				<input type="hidden" name="addRasp" value="t"/>

					<label for="name" class="cols-sm-2 control-label">Добавить занятие</label>
						
						<div class="form-group"> 
							<label for="name" class="cols-sm-2 control-label">Группа</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<select class="form-control"	name="group_id" id="group_id">
										<option value="0">- выберите группу -</option>
										<?php foreach ($groups as $key => $value) : ?>
										<option value="<?=$value['id_group']?>"><?=$value['NameOfGrups']?></option>
<?php endforeach;?>
									</select>
								</div>
							</div>
						</div>
						

						<div class="form-group"> 
							<label for="name" class="cols-sm-2 control-label">Дисциплина</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<select class="form-control" name="disc_id" id="disc_id" disabled="disabled">
										<option value="0">- выберите дисциплину -</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group"> 
							<label for="name" class="cols-sm-2 control-label">Повтор</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<input  type="radio"	id="radio1"  	name="radio" 	value="0" checked> еженедельно <br>
									<input  type="radio"	id="radio2"		name="radio" 	value="1"> каждые две недели <br>
								</div>
							</div>
						</div>
						
						<div class="form-group"> 
							<div class="cols-sm-10 float-left">
								<label for="username" class="cols-sm-2 control-label">Дата</label>
								<div class="input-group">
									<span class="input-group-addon input-group-half"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="date" class="form-control" value="" name="date"/>
								</div>
							</div>
						</div>
						
						<div class="form-group ">
							<input type="submit" value="Добавить" class="btn btn-primary btn-lg btn-block login-buttonl" name="confirm"  placeholder="Зарегестрироваться"/>
						</div>

				</form>

			</div>
		</div>
	</div>


	<div class="footer">
	
	</div>

</div>