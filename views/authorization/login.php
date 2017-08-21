<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $this->title = "ГУД | Авторизация"; ?>
<h3 class="container-center-authorisation-label">Авторизируйтесь в Системе</h3>


<?php $form = ActiveForm::begin(); ?>
<div class="container-center-authorisation-fields">
	<?=$form->field($login_model, 'login')->textInput([
			'class' => 'reg-auth-field',
			'autofocus' => true,
			'placeholder' => 'Введите логин...',
	])
		->label(''); ?>

	<?=$form->field($login_model, 'password')->passwordInput([
			'class' => 'reg-auth-field',
			'placeholder' => 'Введите пароль...',
	])
		->label(''); ?>
	<div class="container-center-authorisation-buttons">
		<?= Html::submitButton('Войти', [
			'id' => 'authorisation-button',
			'class' => 'main-menu-button',
		]); ?>
		<?= Html::a('Еще не зарегистрированы на сайте?', ['/registration/signup'], ['class' => 'non-registred-yet-link']) ?>
	</div>

</div>
<?php ActiveForm::end(); ?>
