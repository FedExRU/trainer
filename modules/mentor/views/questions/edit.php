<?php $this->title = "ГУД | Редактировать вопрос"; ?>

<?php 
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

<h2>Редактировать вопрос</h2><br>


<?= $form->field($model, 'text')->textArea([
		'autofocus' => true, 
		'class' => 'big-field', 
		'placeholder' => 'Введите текст вопроса...'
	])
	->label('Измените текст вопроса*');
?>

<?= $form->field($uploadForm, 'imageFile')->fileInput()
	->label('Измените изображение') ?>
