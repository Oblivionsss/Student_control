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
			<a href="/application/core/Logout.php">Выход</a>
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

		<div class="content_inner">
			




			<div class="block_input">

				<label for="name" class="cols-sm-2 control-label">Добавить дисциплину</label>
				<form id="disc" method="post" action="">
		
					<input type="hidden" name="disc" value="t"/>
			
					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Название дисциплины*</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="NameDisc" value="" placeholder="Введите название дисциплины"/>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Количество часов</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="CountHours" value="" placeholder="Укажите количество часов дисциплины"/>
							</div>
						</div>
					</div>
					
					<div class="form-group ">
						<input type="submit" value="Добавить" class="btn btn-primary btn-lg btn-block login-buttonl" name="confirm"  placeholder="Зарегестрироваться"/>
					</div>
				</form>

			</div>







			<div class="block_input">

				<label for="aj" class="cols-sm-2 control-label">Добавить группу</label>
				<form id="group" method="post" action="">
		
					<input type="hidden" name="group" value="t"/>

					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Название группы*</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="nameGroups" value="" placeholder="Введите название группы"/>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Курс*</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="Course" value="" placeholder="Выберите курс"/>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Выберите уровень образования*</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="level" value="" placeholder="Укажите количество часов дисциплины"/>
							</div>
						</div>
					</div>
					
					<div class="form-group ">
						<input type="submit" value="Добавить" class="btn btn-primary btn-lg btn-block login-buttonl" name="confirm"  placeholder="Зарегестрироваться"/>
					</div>
				</form>
			</div>






			<div class="block_input">
				
					<label for="name" class="cols-sm-2 control-label">Добавить студента</label>
					<form id="stud" method="post" action="">
					<input type="hidden" name="stud" value="t"/>

					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Имя студента*</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="nameSt" value="" placeholder="Введите имя"/>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Фамилия студента*</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="nameSn" value="" placeholder="Введите фамилию"/>
							</div>
						</div>
					</div>

					<div class="form-group"> 
						<label for="name" class="cols-sm-2 control-label">Группа</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<!-- <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span> -->
								<select class="form-control" name="groups_id" id="groups_id">
								<option value="0">- выберите группу -</option>
								<?php foreach($groups as $key=> $value) :?>
									<option value="<?= $value['id'] ?>"><?= $value['NameOfGrups'] ?></option>
<?php endforeach;?>
								</select>
							</div>

						</div>	
					</div>

					<div class="form-group ">
						<input type="submit" value="Добавить" class="btn btn-primary btn-lg btn-block login-buttonl" name="confirm"  placeholder="Зарегестрироваться"/>
					</div>

				</form>
			</div>





			<div class="block_input">
				
				<label for="name" class="cols-sm-2 control-label">Связать дисциплину и группу</label>
				<form id="discgroup" method="post" action="">
					<input type="hidden" name="discgroup" value="t"/>
					
					<div class="form-group"> 
						<label for="name" class="cols-sm-2 control-label">Группа</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<!-- <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span> -->
								<select class="form-control" name="groupselect" id="groupselect_id">
								<option value="0">- выберите группу -</option>
								<?php foreach($groups as $key=> $value) :?>
									<option value="<?= $value['id'] ?>"><?= $value['NameOfGrups'] ?></option>
<?php endforeach;?>
								</select>
							</div>

						</div>	
					</div>

					<div class="form-group"> 
						<label for="name" class="cols-sm-2 control-label">Дисциплина</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<!-- <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span> -->
								<select class="form-control" name="discselect" id="discselect_id">
								<option value="0">- выберите дисциплину-</option>
								<?php foreach($disc as $key=> $value) :?>
									<option value="<?= $value['id'] ?>"><?= $value['Name'] ?></option>
<?php endforeach;?>
								</select>
							</div>

						</div>	
					</div>
					
					
					
					

					<div class="form-group ">
						<input type="submit" value="Добавить" class="btn btn-primary btn-lg btn-block login-buttonl" name="confirm"  placeholder="Зарегестрироваться"/>
					</div>
				</form>
			</div>
	</div>


	<div class="footer">
	
	</div>

</div>