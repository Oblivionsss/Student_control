<link href="/public/style/account/register.css" rel="stylesheet"  type="text/css" media="screen" />	


    <!-- header -->
    <header class="blog-header py-3">
		<div class="row flex-nowrap justify-content-between align-items-center">
			<div class="col-4 pt-1">
			
			</div>
			<div class="col-md text-center">
				<a class="blog-header-logo text-dark" href="#">Система мониторинга студентов РТУ</a>
			</div>
			
			<div class="col-4 d-flex justify-content-end align-items-center">
				<a class="btn btn-md btn-outline-secondary" href="/">На главную</a>
                <a class="btn btn-md btn-outline-secondary" href="/account/login">Войти</a>
            </div>
		</div>
	</header>
    <!-- end header -->

    <div class="content text-center h-100">
        <form class="form-signin bg-light rounded"  id="register"   action="/account/login/"    method="POST">
        
        <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
        
        <label for="inputEmail">Логин</label>
        <input type="text"      name="login"            class="form-control" placeholder="Login name" required="" autofocus="">
        
        <label for="inputPassword">Пароль</label>
        <input type="password"  name="password"         class="form-control" placeholder="Password" required="">
        
        <label for="inputPassword">Введите повторно пароль</label>
        <input type="password"  nane="confirmPassword"  class="form-control" placeholder="Confirm password" required="">
        
        <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Войти</button>
        
        <p class="mt-3 mb-2 text-muted">© 2018-2019</p>
        
        </form>
    </div>
