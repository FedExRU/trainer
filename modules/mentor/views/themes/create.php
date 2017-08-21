<?php $this->title = "ГУД | Создать тему"; ?>

<?php 
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
?>

<h2>Создать тему</h2> <br /><br />

<div class="container-center-create-theme">
<?php $form = ActiveForm::begin();?>

<?= $form->field($model, 'name')->textInput([
		'autofocus' => true, 
		'class' => 'reg-auth-field', 
		'placeholder' => 'Введите название темы'
	])
	->label('Введите название темы');
?>

<?= $form->field($model, 'pass_mark')->textInput([
		'class' => 'numberic-field', 
		'placeholder' => '0',
		'type' => 'number'
	])
	->label('Укажите минимальный порог оценки "Удовлетворительно"');
?>

<?= $form->field($model, 'dece_mark')->textInput([
		'class' => 'numberic-field', 
		'placeholder' => '0',
		'type' => 'number'
	])
	->label('Укажите минимальный порог оценки "Хорошо"');
?>

<?= $form->field($model, 'exce_mark')->textInput([
		'class' => 'numberic-field', 
		'placeholder' => '0',
		'type' => 'number'
	])
	->label('Укажите минимальный порог оценки "Отлично"');
?>

<div class="theme-create">
<a href="javascript:history.back();" class="back-button-a" id="left">Назад</a>
<?= Html::submitButton('Создать', [
        'class' => 'main-menu-button',
        'id' => 'right',
    ]); 
?>
</div>
<?php $form = ActiveForm::end();?>
</div>