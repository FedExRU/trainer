<?php 
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
?>

<?php $this->title = 'ГУД | Сервис - Добавить новый предмет'; ?>

<h2>Добавить новый предмет</h2>
<br />
<?php $form = ActiveForm::begin(); ?>

	<?=$form->field($model, 'name')->textInput([
		'autofocus' => true,
		'class' => 'reg-auth-field',
		'placeholder' => 'Введите название предмета...',
	])
	->label(false);?>
	<br />
	<?=$form->field($model, 'fac_id')->dropDownList($array_faculcy, [
		'class' => 'reg-auth-field',
		'id' => 'type',
		'prompt' => 'Выберите факультет...'
	])
	->label(false);
	?>

	<br />
	<br />
	<div class="question-create">

		<?= Html::a('Назад', ['/admin'], [
			'class' => 'back-button-a', 
			'id' => 'left'
		]) ?>

		<?= Html::submitButton('Создать', [
	        'class' => 'main-menu-button',
	        'id' => 'right',
	    ]); ?>

	</div>

<?php ActiveForm::end(); ?>