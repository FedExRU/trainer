<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$list = <<< JS
    $("h4.container-center-themes-subject-label").click(function(){
    	$(this).next().slideToggle();
    	if($(this).find('#subj-arrow').text() == '▼')
    		$(this).find('#subj-arrow').text('▲');
    	else
    		$(this).find('#subj-arrow').text('▼');
    });
JS;

$chekedTypesList = <<< JS
  $(".container-center-types-radio").click(function(){
  	$(".container-center-types-radio").css('background-color', '');
  	$(this).css('background-color', '#599333');
  });
JS;

$chekedThemesList = <<< JS
  $(".container-center-themes-themes-block-radio").click(function(){
  	$(".container-center-themes-themes-block-radio").css('background-color', '');
  	$(this).css('background-color', '#599333');
  });
JS;

$this->registerJs($list, yii\web\View::POS_READY);
$this->registerJs($chekedTypesList, yii\web\View::POS_LOAD);
$this->registerJs($chekedThemesList, yii\web\View::POS_LOAD);
?>
<?php $this->title = "ГУД | Главная"; ?>

<div class="container-center-heading">
	<h2>Главное меню направления <?=$cathedraInfo->short_name ?> гр. <?= Yii::$app->user->identity->group_number ?></h2>
</div>

<?php  $form = ActiveForm::begin([
	'action' =>['test/create'], 
	'method' => 'post',
	]); 
?>

<div class="center-container-labels">
	<h3 class="center-container-labels-heading" id="type-label">Выберите тип экзаменовки</h3>
	<h3 class="center-container-labels-heading" id="theme-label">Выберите предмет</h3>
</div>

<div class="container-center-types-themes">

	<div class="container-center-types">
		<?php foreach ($types as $type): ?>
		
			<h5><label class = "container-center-types-radio"><input type="radio" class="container-center-themes-themes-block-radio-marker" name="type_id" value="<?= $type->type_id ?>" required><?= $type->name ?></label></h5>
		
		<?php endforeach ?>
	</div>

	<?php if($subjects != NULL): ?>
	<div class="container-center-themes">
		<?php foreach ($subjects as $subject): ?>

			<h4 class="container-center-themes-subject-label"><?= $subject->name ?><b id="subj-arrow">▼</b></h4>
			<div class="container-center-themes-themes-block">
				<?php foreach ($themes as $theme): ?>
						<?php 
							if($theme->subj_id==$subject->subj_id) 
							{
								echo "<h5><label class = 'container-center-themes-themes-block-radio'><input type ='radio' class = 'container-center-themes-themes-block-radio-marker' name = 'theme_id' value ='".$theme->theme_id."' required>".$theme->name."<label></h5>";
							}
						?>
				<?php endforeach ?>
			</div>
		<?php endforeach ?>
	</div>
	<?php else: ?>
		<h3 class="non-subjects">В данный момент группе не назначено ни одного предмета.</h3>
	<?php endif;?>
</div>

<?php if($subjects != NULL): ?>
<div class="container-center-buttons">

	<?=Html::submitButton('Приступить', [
		'class' => 'main-menu-button',
		'id' => 'button-continue',
		])
	?>

</div>
<?php endif;?>
<?php ActiveForm::end(); ?>

