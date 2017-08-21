<?php use yii\helpers\Html; ?>
<?php $this->title = "ГУД | Успешная регистрация"; ?>

<div class="container-center-labels">
	<h2 id="name-label"><?=$model->last_name?> <?=$model->middle_name?>, регистрация прошла успешно!</h2>
	<b id="name-label-info">Для входа в личный кабинет используйте следующие авторизационные данные:</b> <br />
	
	<div class="container-center-info-labels">
		<h3 id = "login-info" class = "container-center-labels-auth-info">Логин: <b><?=$exampleLogin ?></b></h3>
		<h3 id = "password-info" class = "container-center-labels-auth-info">Пароль: <b><?=$examplePassword ?></b></h3>
	</div>
</div>
<br />

<?= Html::a('Войти в Систему', ['/authorization/prelogin', 'preLogin' => $exampleLogin, 'prePassword' => $examplePassword], ['class' => 'main-menu-button', 'id' => 'sign-in-button']) ?>
