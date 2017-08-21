<?php $this->title = "ГУД | Статистика групп"; ?>


<?php 
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use app\models\User;
?>


<?php 

$onLoad = "

$('#group-stat').append( '<h3 class = \"start-search\">Выберете номер группы, по которой Вы желаете увидеть статистику</h3>' );
	
";

$this->registerJs($onLoad, yii\web\View::POS_READY);

$showStat = "

$('#show-button-stat').click(function(){
	var a = $('#group_number').val();
	$('#group-stat').load('/mentor/statistics/showstat?subj_id=".$subj_id."&group_number='+a+'');
	//$('#group-stat').load('/mentor/statistics/showstat');
});
	
";

$this->registerJs($showStat, yii\web\View::POS_READY);

$print = "

$('.print').click(function(){
	var a = $('#group_number').val();

	if(a == '')
		alert('Для сохранения отчета необходимо сгенерировать статистику группы!');
	else{
		window.open('/mentor/statistics/report?subj_id=".$subj_id."&group_number='+a+'', '_blank');
	}
});
	
";

$this->registerJs($print, yii\web\View::POS_READY);

?>

<h2>Статистика групп по дисциплине <?= $subject?></h2> <br>

<?php $form = ActiveForm::begin();?>

<div class="statistics-options">

	<label>Выберете группу, по которой необходимо вывести статистику</label><br>

	<?php if($groups != NULL): ?>
		<?= Html::dropDownList('group_number', null, $groups, [
			'class' => 'stat-group-list', 
			'prompt' => 'Выберете номер группы...',
			'id '=> 'group_number',
			]); 
		?>
	<?php endif;?>
	<?= Html::button('Сгенерировать', [
	        'class' => 'stat-button',
	        'id' => 'show-button-stat',
	    ]); 
	?>

	<?= Html::a('Сохранить статистику 💾', false, ['class' => 'print' ,'id' => 'right'])?>	

</div>

<?php ActiveForm::end();?>



<h3 class="stat-label">Окно вывода статистики</h3>
<div id="group-stat">
	
</div>

<div style="margin-right: 27px; margin-bottom: 10px; height: 50px; width: 960px;">
	<a href="/mentor" class="back-button-a">Назад</a>
</div>

