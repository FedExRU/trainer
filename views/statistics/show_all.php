<?php 

use yii\helpers\Html; 
?>

<?php 

$searchStat = "

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

    $('#student-stat').load('/statistics/showframe?subj_id='+subject+'&type_id='+type+'&theme_id='+theme+'');
});
    
";

$this->registerJs($searchStat, yii\web\View::POS_READY);


$onLoad = "

    var subject = $('#subjects').val();
    var type = $('#types').val();
    var theme = $('#themes').val();

    if(type == '')
        type = null;

    if(theme == '')
        theme = null;

    if(subject == '')
        subject = null;

    $('#student-stat').load('/statistics/showframe?subj_id='+subject+'&type_id='+type+'&theme_id='+theme+'');
    
";

$this->registerJs($onLoad, yii\web\View::POS_READY);
?>


<?php $this->title = "ГУД | Пройденные работы";?>

<div class="container-center-heading">
	<h2>Реестр пройденных работ</h2>
</div>

<h3>Поиск</h3>

<div class="search-block">

<?php if($subjects != NULL):?>

<label>По предмету</label>

<?= Html::dropDownList('subj_id', 'name', $subjects, [ 
        'prompt' => 'Все предметы',
        'class' => 'student-filter-stat',
        'id '=> 'subjects',
    ]); 
?>
<?php endif;?>

<?php if($types != NULL):?>

<label>По типу</label>

<?= Html::dropDownList('type_id', 'name', $types, [ 
        'prompt' => 'Все типы',
        'class' => 'student-filter-stat',
        'id '=> 'types',
    ]); 
?>
<?php endif;?>

<?php if($themes != NULL):?>

<label>По теме</label>

<?= Html::dropDownList('theme_id', 'name', $themes, [ 
        'prompt' => 'Все темы',
        'class' => 'student-filter-stat',
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


<div class="container-center-statistics-block" id="student-stat">
	


</div>
<div style="width: 881px;">
<a href="javascript:history.back();" class="main-menu-button" id="back-button-satistics">Назад</a>
</div>
