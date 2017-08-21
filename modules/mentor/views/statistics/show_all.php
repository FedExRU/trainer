<?php 
	use yii\helpers\Html;
?>

<?php 
	
$onLoadPage = "
	$('#students').val(".$user_id.");
	$('#themes').val(".$theme_id.");
	$('#types').val(".$type_id.");
	var student = $('#students').val();

	var type = $('#types').val();
	var theme = $('#themes').val();

	if(type == '')
		type = null;

	if(theme == '')
		theme = null;

	if(student == '')
		student = null;


	$('#stat').load('/mentor/statistics/showframe?subj_id=".$subj_id."&user_id=' +student+'&theme_id='+theme+'&type_id='+type+'');
	
";

$this->registerJs($onLoadPage, yii\web\View::POS_READY);

$searchStat = "

$('#search').click(function(){
	var student = $('#students').val();
	var type = $('#types').val();
	var theme = $('#themes').val();

	if(type == '')
		type = null;

	if(theme == '')
		theme = null;

	if(student == '')
		student = null;

	$('#stat').load('/mentor/statistics/showframe?subj_id=".$subj_id."&user_id=' +student+'&theme_id='+theme+'&type_id='+type+'');
});
	
";

$this->registerJs($searchStat, yii\web\View::POS_READY);
?>

<?php $this->title = "ГУД | Экзаменовки"; ?>

<h2>Экзаменовки по предмету <?=$subject?></h2>

<h4>Поиск</h4>

<div class="search-block">

<?php if($students != NULL):?>
<label>По студенту</label>

<?= Html::dropDownList('user_id', 'first_name', $students, [ 
		'prompt' => 'Все студенты',
		'class' => 'mentor-filter-stat',
		'id '=> 'students',
	]); 
?>
<?php endif;?>

<?php if($types != NULL):?>
<label>По типу</label>
<?= Html::dropDownList('type_id', 'name', $types, [ 
		'prompt' => 'Все типы',
		'class' => 'mentor-filter-stat',
		'id '=> 'types',
	]); 
?>

<?php endif;?>

<?php if($themes != NULL):?>
<label>По теме</label>
<?= Html::dropDownList('theme_id', 'name', $themes, [	 
		'prompt' => 'Все темы',
		'class' => 'mentor-filter-stat',
		'id '=> 'themes',
	]); 
?>

<?php endif;?>

<?php if($themes != NULL || $students != NULL || $types != NULL):?>
<?= Html::button('Поиск', [
	    'class' => 'stat-button',
	    'id' => 'search',
	]); 
?>
<?php endif;?>
</div>

<div class="container-center-statistics-block" id="stat">

</div>
<div style="width: 881px;">
<a href="javascript:history.back(-2);" class="main-menu-button" id="back-button-satistics">Назад</a>
</div>