<?php 
	use yii\helpers\Html; 
?>
<?php $this->title = "ГУД | Параметры оценивания тем предмета";?>

<?php 

$onLoadPage = "


    var subject = $('#subjects').val();
    var type = $('#types').val();
    var theme = $('#themes').val();

    if(type == '')
        type = null;

    if(theme == '')
        theme = null;

    if(subject == '')
        subject = null;

    $('#evaluation').load('/mentor/evaluation/showframe?subj_id='+subject+'&type_id='+type+'&theme_id='+theme+'');

    
";

$this->registerJs($onLoadPage, yii\web\View::POS_READY);

$searchEva = "

$('#search').click(function(){
    var subject = $('#subjects').val();
    var type = $('#types').val();
    var theme = $('#themes').val();

    if(type == '')
        type = null;

    if(theme == '')
        theme = null;

    if(subject == '')
        subject = null;

     $('#evaluation').load('/mentor/evaluation/showframe?subj_id='+subject+'&type_id='+type+'&theme_id='+theme+'');
});
    
";

$this->registerJs($searchEva, yii\web\View::POS_READY);

?>

<h2>Параметры оценивания тем предмета</h2>
<br />

<h4>Поиск</h4>

<div class="search-block">

<?php if($subjects != NULL):?>

<label>По предмету</label>

<?= Html::dropDownList('subj_id', 'name', $subjects, [ 
		'prompt' => 'Все предметы',
		'class' => 'mentor-filter-stat',
		'id '=> 'subjects',
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


<?php if($themes != NULL || $subjects != NULL || $types != NULL):?>

<?= Html::button('Поиск', [
        'class' => 'stat-button',
        'id' => 'search',
    ]); 
?>
<?php endif;?>


</div>

<div class="eva-block" id="evaluation">

	

</div>


<div class="eva-buttons-block">
	<?= Html::a('Добавить', ['/mentor/evaluation/create'], ['class'=>'main-menu-button-a']) ?>
	<a href="/mentor/evaluation/show" class="back-button-a">Назад</a>
</div>
