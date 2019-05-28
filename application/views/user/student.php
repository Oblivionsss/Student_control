<link href="/public/style/reset.css" rel="stylesheet"  type="text/css" media="screen" />	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<link href="/public/style/user.css" rel="stylesheet"  type="text/css" media="screen" />	

<script src="/public/script/select.js"></script> 
<script src="/public/script/formControl.js"></script> 

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
			<div>
				<form action="#" method="get">
					<div class="form-group inline"> 
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
						

						<div class="form-group inline"> 
							<label for="name" class="cols-sm-2 control-label">Дисциплина</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<select class="form-control" name="disc_id" id="disc_id" disabled="disabled">
										<option value="0">- выберите дисциплину -</option>
									</select>
								</div>
							</div>
						</div>

				</form>
			</div>


			<!-- Таблица со списком студентов -->
			<div>
				<table>
					<!-- Блок заголовков - определяющих дату -->
					<thead>
						<tr>
							<th style="border:none"></th>
						</tr>
					</thead>
				  	<!--   -->
					
					<!-- Блок списков студентов и их успеваемости -->
					<tbody>
					
					</tbody>
					<!--  -->

				</table>
			</div>
			<!--  -->
		

		</div>
	
	</div>

	<!-- Нижняя часть страницы -->
	<div class="footer">
	
	</div>

</div>