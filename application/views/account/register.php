<div class="auth">
    
    <div class="register">
        <label for="form" class="cols-sm-2 control-label">Регистрация</label>
        <form id="disc" method="post" action="">

            <input type="hidden" name="disc" value="t"/>
    
            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Логин</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="login" value="" placeholder="Введите Ваш логин"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Пароль</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" name="password" value="" placeholder="Введите Ваш пароль"/>
                    </div>
                </div>
            </div>

            <div class="form-group ">
                <input type="submit" value="Зарегестрироваться" class="btn btn-primary btn-lg btn-block login-buttonl" name="confirm"  placeholder="Зарегестрироваться"/>
            </div>

            <div class="form-group ">
                <label  class="cols-sm-2 control-label"><a href="/account/login">Авторизоваться</a></label>
            </div>

        </form>

    </div>
</div>