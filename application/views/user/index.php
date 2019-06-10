<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="/public/script/rasp/loadRasp.js"></script> 

	<div class="content">

		<div class="menu">
			<div class="container-menu">
				
				<div class="menu-link active">
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

		<div class="content_inner non_flex">


				<table class="table table-hover table_size">
					<!-- Блок заголовков - определяющих дату -->
					<!-- <thead>
						<tr>
							<th></th>
						</tr>
					</thead> -->
				  	<!--   -->
					
					<!-- Блок списков студентов и их успеваемости -->
					<tbody>
						
					</tbody>
					<!--  -->

				</table>


			
			<div class="block_input center">


				<input type="checkbox" id="hd-1" class="hide"/>
				<label for="hd-1" class="cols-sm-2 control-label">
					<i class="fa fa-chevron-down"></i>
					Добавить расписание
				</label>
				
				<form action="/api/groups_disc_info/" method="POST" id="add">
						
						<div class="form-group"> 
							<label for="name" class="cols-sm-2 control-label">Группа</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<select class="form-control"	name="group_id" id="group_id" disabled="disabled">
										<option value="0">- выберите группу -</option>
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
									<input  type="radio"	id="radio2"		name="radio" 	value="2"> один раз <br>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="cols-sm-10">
									<label for="username" class="cols-sm-2 control-label">Дата</label>
								<div class="input-group">
									<span class="input-group-addon input-group-half"></span>
									<input type="date" class="form-control" value="" name="date"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Время занятий</label>
								<div class="cols-sm-10">
									<div class="input-group">
									<select class="form-control" name="pars">
										<option value="0">- укажите пару -</option>
										<option value="1"> первая пара </option>
										<option value="2"> вторая пара </option>
										<option value="3"> третья пара </option>
										<option value="4"> четвертая пара </option>
										<option value="5"> пятая пара </option>
										<option value="6"> шестая пара </option>
										<option value="7"> седьмая пара </option>
										<option value="8"> восьмая пара </option>
									</select>	  
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Аудитория</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"></span>
									<input type="text" class="form-control" name="lectureHall" value="" placeholder="укажите аудиторию"/>
								</div>
							</div>
						</div>
						
						<div class="form-group ">
							<input type="submit" value="Добавить" class="btn btn-primary btn-lg btn-block login-buttonl" name="confirm"  placeholder="Добавить"/>
						</div>

				</form>

			</div>
		</div>
	</div>
<script src="/public/script/rasp/addDate.js"></script> 



