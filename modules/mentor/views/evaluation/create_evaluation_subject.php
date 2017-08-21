<?php 
	use yii\helpers\Html; 
	use yii\widgets\ActiveForm;
	use kartik\slider\Slider;
	use yii\helpers\ArrayHelper;
?>
<?php $this->title = "ГУД | Добавить параметр оценивания предмета";?>

<h2>Добавить параметр оценивания предмета</h2> 

<div class="container-center-add-param">

<?php $form = ActiveForm::begin(); ?>

<?=$form->field($model, 'subj_id')
		->dropDownList($subjects, [
           'class' => 'add-eva-field',
           'prompt'=>'Выберете предмет...', 
  		])
       ->label(''); 
?>

<label>Укажите минимальный процент всех пройденных работ<p> по предмету</label> <br /> <br />
<?=  "<b id = 'min-mark'>0%</b>".Slider::widget([
    'name' => 'slider',
    'value' => 70,
    'sliderColor' => '#599333',
    'handleColor' => '#bbb',
    'pluginOptions' => [
        'orientation' => 'horizontal',
        'handle' => 'round',
        'min' => 0,
        'max' => 100,
        'step' => 1
    ],
])."<b id = 'max-mark'>100%</b>"; 

?>

<div class="eva-buttons-block" id="create-eva">
	<?= Html::submitButton('Добавить', [
        'class' => 'main-menu-button',
        'id' => 'right',
    ]); ?>
	<a href="/mentor/evaluation/subjects_evaluation" class="back-button-a" id="left">Назад</a>
</div>

<?php ActiveForm::end();?>

</div>

