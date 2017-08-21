<?php


/*********************Begin js depended dropdown list*********************/				

$clearCathedrasField = <<< JS
    $("#faculties-name :first").attr("disabled", "disabled");
JS;

/*********************End js depended dropdown list*********************/

$this->title = 'ГУД | Регистрация';
$this->registerJs($clearCathedrasField, yii\web\View::POS_READY);

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<h3 class="container-center-registration-label">Зарегистрируйтесь в системе</h3> <br>
<?php $form = ActiveForm::begin([
  'options' => [
      'class' => '',
  ],
]); ?>

<div class="container-center-registration-fields">

	<?=$form->field($model, 'first_name')->textInput([
		    'autofocus' => 'true',
		    'placeholder' => 'Введите фамилию...',
        'class' => 'reg-auth-field',
	])
       ->label(''); ?>

	<?=$form->field($model, 'last_name')->textInput([
		    'autofocus' => 'true',
		    'placeholder' => 'Введите имя...',
        'class' => 'reg-auth-field',
	])
       ->label(''); ?>

	<?=$form->field($model, 'middle_name')->textInput([
		    'autofocus' => 'true',
		    'placeholder' => 'Введите отчество...',
        'class' => 'reg-auth-field',
	])
       ->label(''); ?>

  	<?=$form->field($Faculties, 'name')->dropDownList($facultiesItems, [
            'class' => 'reg-auth-field',
            'prompt'=>'Выберите факультет...', 
            'onchange'=>'$.post( "/registration/showcath?id='.'"+$(this).val(), function(data){
                            $("select#cathedras-name").html(data); });',
    ])
        ->label(''); ?>

	<?=$form->field($Cathedras, 'name')->dropDownList([], [
            'class' => 'reg-auth-field',
            'prompt'=>'Выберите направление...',
            'onchange'=>'$.post( "/registration/showgroups?id='.'"+$(this).val(), function(data){
                            $("select#signup-group_number").html(data); });', 
    ])
        ->label(''); ?>

    <?=$form->field($model, 'group_number')->dropDownList([], [
           'class' => 'reg-auth-field',
           'prompt'=>'Выберите номер группы...', 
    ])
        ->label(''); 
    ?>
</div>
<div class="container-center-registration-buttons">

	<?= Html::submitButton('Регистрация', [
        'id' => 'registration-button',
        'class' => 'main-menu-button',
    ]); 
  ?>
  <?php ActiveForm::end() ?>
  <a href="javascript:history.back();" class="back-button-a" id="left">Назад</a>

</div>



