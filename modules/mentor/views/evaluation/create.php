<?php 
	use yii\helpers\Html; 
	use yii\widgets\ActiveForm;
	use kartik\slider\Slider;
	use yii\helpers\ArrayHelper;
?>
<?php $this->title = "ГУД | Добавить параметр оценивания";?>

<h2>Добавить параметр оценивания</h2> 

<div class="container-center-add-param">
<?php $form = ActiveForm::begin(); ?>

<?=$form->field($model, 'subj_id')
		->dropDownList($subjects, [
           'class' => 'add-eva-field',
           'prompt'=>'Выберете предмет...', 
           'onchange'=>'$.post( "/mentor/evaluation/showthemes?subj_id='.'"+$(this).val(), function(data){
                            $("select#theme-field").html(data); });',
  		])
       ->label(''); 
?>

<?=$form->field($model, 'theme_id')
		->dropDownList([], [
           'class' => 'add-eva-field',
           'prompt'=>'Выберете тему...', 
           'id' => 'theme-field',
  		])
       ->label(''); 
?>

<?=$form->field($model, 'type_id')
		->dropDownList($types, [
           'class' => 'add-eva-field',
           'prompt'=>'Выберете тип...', 
  		])
       ->label(''); 
?>

<label>Укажите минимальный порог прохождения работы</label> <br />
<?=  "<b id = 'min-mark'>0</b>".Slider::widget([
    'name' => 'slider',
    'value' => 2.5,
    'sliderColor' => '#599333',
    'handleColor' => '#bbb',
    'pluginOptions' => [
        'orientation' => 'horizontal',
        'handle' => 'round',
        'min' => 0,
        'max' => 5,
        'step' => 0.1
    ],
])."<b id = 'max-mark'>5</b>"; 

?>

<br />
<br />
<br />

<label>Укажите тип оценивания</label> <br />

<?php foreach($evaTypes as $et):?>
	<div class="radio">
		<label><?=Html::radio('EvaluationConfig[eva_id]', 'checked', ['value' => $et->eva_id]) ?><?=$et->name?><img src = "/img/another/exclamation-point11.jpg" class = "notice" title = "<?=$et->description?>"></label>
	</div>
<?php endforeach;?>



<div class="eva-buttons-block" id="create-eva">
	<?= Html::submitButton('Добавить', [
        'class' => 'main-menu-button',
        'id' => 'right',
    ]); ?>
	<a href="/mentor/evaluation/show" class="back-button-a" id="left">Назад</a>
</div>


<?php ActiveForm::end();?>
</div>

