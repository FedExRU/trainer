<?php $this->title = "ГУД | Создать вопрос"; ?>


<?php 
	$list2 = <<< JS
    if($('input[type="radio"]:checked').length > 0){
   alert('asdsad');
}
JS;

$this->registerJs($list2, yii\web\View::POS_READY);
?>

<?php 

$showBlocks = <<< JS
$("#type").change(function(){
	if($("#type").val() == 2)
	{
		$("#practice-field").hide();
		$("#check-types").show();
		$("#answers-fields").show();
	}
	else if($("#type").val() == 3)
	{
		$("#check-types").hide();
		$("#practice-field").show();
		$("#answers-fields").hide();
		$(".checkradio").prop( "checked", false );
		$(".create-answers-block").hide();
	}
	else
	{
		$("#check-types").hide();
		$("#practice-field").hide();
		$("#answers-fields").hide();
		$(".checkradio").prop( "checked", false );
		$(".create-answers-block").hide();
	}
});
    
$('.checkradio').change(function(){
	$(".create-answers-block").show();
})
JS;

$this->registerJs($showBlocks, yii\web\View::POS_READY);

$showTestAnswers = "
$('#create-button').click(function(){

	if($('#radio').prop('checked'))
		$('#answers-fields').load('/mentor/questions/showanswers?count='+$('#count-questions').val()+'&input_type=radio');

	if($('#checkbox').prop('checked'))
		$('#answers-fields').load('/mentor/questions/showanswers?count='+$('#count-questions').val()+'&input_type=checkbox');
});
    

";

$this->registerJs($showTestAnswers, yii\web\View::POS_READY);

$showPracticeAnswer = "
$('#type').change(function(){
	if($('#type').val() == 3)
	{
		$('#practice-field').load('/mentor/questions/showpacticefield');
	}
});
";

$this->registerJs($showPracticeAnswer, yii\web\View::POS_READY);


?>

<?php 
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
?>

<h2>Создать вопрос</h2>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

<?=$form->field($model, 'type_id')->dropDownList($typesItems, [
            'class' => 'reg-auth-field',
            'id' => 'type',
            'prompt'=>'Выберите тип вопроса...', 
    ])
    ->label('Выберите тип вопроса*'); ?>

<?= $form->field($model, 'questionText')->textArea([
		'autofocus' => true, 
		'class' => 'big-field', 
		'placeholder' => 'Введите текст вопроса...'
	])
	->label('Введите текст вопроса*');
?>

<?= $form->field($uploadForm, 'imageFile')->fileInput()
	->label('Загрузите изображение') ?>

<div id="check-types">
<?= $form->field($model, 'input_type')
    ->radioList([
    	'radio' => 'Один ответ из представленных',
    	'checkbox' => 'Несколько ответов из представленных ',
    ], [
    	'item' => function ($index, $label, $name, $checked, $value) {
            return
            '<div class="radio"><label>' . Html::radio($name, $checked, ['value' => $value, 'class' => 'checkradio', 'id' => $value]) . $label . '</label></div>';
        },
        'id' => 'input_type',])
    ->label('Выберите тип ответов') ?>
</div>

<div class="create-answers-block">

<label>Укажите количество вопросов</label><br>

<input type="number" id="count-questions" class="numberic-field" placeholder="0">

<?= Html::button('Создать', [
	        'class' => 'medium-button-two',
	        'id' => 'create-button',
	    ]); 
	?>

</div>

<div id="answers-fields">
	
</div>

<div id="practice-field">

</div>

<div class="question-create">
	<a href="javascript:history.back();" class="back-button-a" id="left">Назад</a>
	<?= Html::submitButton('Создать', [
	        'class' => 'main-menu-button',
	        'id' => 'right',
	    ]); 
	?>
</div>

<?php $form = ActiveForm::end();?>