<script src="/public/script/setting/settingDate.js"></script> 
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
                
                <div class="menu-link active">
					<a href="/user/setting">Настройки</a>
                </div>
                
			</div>
		</div>

		<div class="content-inner">
           
            <div class="block_input input-center ">
            <form class="setting" method="POST" action="/api/users_info/" id="setting">
            <input type="hidden" name="method" value='PUT'>
                <div class="form-group">
                    <label for="name" class="cols-sm-2 control-label">Имя</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                           
                            <input type="text" class="form-control" name="Name" value="" placeholder="Введите Ваше имя"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="cols-sm-2 control-label">Фамилия</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" name="Surname" value="" placeholder="Введите Ваше имя"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="cols-sm-2 control-label">Отчество</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" name="Matern" value="" placeholder="Введите Ваше имя"/>
                        </div>  
                    </div>
                </div>

                <div class="form-group">
                    <div class="cols-sm-10">
                            <label for="username" class="cols-sm-2 control-label">Год рождения</label>
                        <div class="input-group">
                            <input type="date" class="form-control" value="" name="DateOfBirth"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="cols-sm-10">
                            <label for="name" class="cols-sm-2 control-label">Яндекс диск</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="YD" value="" placeholder="Ссылка на ваш ЯД"/>
                        </div>  
                    </div>
                </div>

                <div class="form-group ">
                    <input type="submit" value="Обновить" class="btn btn-primary btn-lg btn-block login-buttonl" name="confirm"  placeholder="Зарегестрироваться"/>
                </div>
            </form>
            </div>

        </div>
        
	</div>

