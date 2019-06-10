<script src="/public/script/student/updateSelect.js"></script> 
<script src="/public/script/formControl.js"></script> 

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<div class="content">

		<div class="menu">
			<div class="container-menu">
                
                <div class="menu-link">
					<a href="/user/rasp">Расписание</a>
				</div>

				<div class="menu-link active">
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
				<form class="select_float" action="#" method="get">
					<div class="form-group inline"> 
							<label for="name" class="cols-sm-2 control-label">Группа</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<select class="form-control"name="group_id" id="group_id">
										<option value="0">- выберите группу -</option>
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
				<table class="table table-striped ">
					<!-- Блок заголовков - определяющих дату -->
					<thead>
						<tr>
							<th></th>
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
	<script src="/public/script/student/ajax.js"></script> 