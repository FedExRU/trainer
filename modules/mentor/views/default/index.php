<?php use yii\helpers\Html;  ?>

<?php $this->title = "ГУД | Список предметов"; ?>

<h2>Главное меню преподавателя кафедры <?=$cathedra?></h2>
<h3>Реестр предметов:</h3>
<br>
<?php if($subjects !=NULL):?>

	<?php for($i = 0; $i < count($subjects); $i++):?>
		<div class="subject-block">
			<h4 class="subject-block-label"><?=$subjects[$i]->name?></h4>
			<div class="info-block">
				<div class="info-sub-block">
					<p class="info-text">Пройденных экзаменовок: <b><?= $countStatistics['total'][$i]?></b></p> <br>
					<p class="info-text">Из них проверенно: <b><?= $countStatistics['viewed'][$i]?></b></p> <br>
					<br>
				</div>
				<div class="info-sub-block">
					<p class="info-text">Количество тем: </p> <br>
					<p class="info-text-second">Всего: <b><?= $countThemes['total'][$i]?> </b></p> <br>
					<p class="info-text-second">Ваших: <b><?= $countThemes['private'][$i]?></b></p> 
				</div>
			</div>
			<div class="subjects-buttons">
				<?= Html::a('Статистика группы', ['/mentor/statistics/group', 'subj_id' => $subjects[$i]->subj_id], ['class' => 'medium-button']) ?>
				<?= Html::a('Создать тему', ['/mentor/themes/create', 'subj_id' => $subjects[$i]->subj_id], ['class' => 'medium-button']) ?>
				<?= Html::a('Экзаменовки', ['/mentor/statistics/showall', 'subj_id' => $subjects[$i]->subj_id], ['class' => 'medium-button']) ?>
				<?= Html::a('Подробнее...', ['/mentor/themes/show', 'subj_id'=> $subjects[$i]->subj_id], ['class' => 'medium-button']) ?>
			</div>
		</div>
	<?php endfor;?>

<?php else:?>
	<h3 class="non-subjects" id="mentor-non-subjects">В данный момент Вам не назначено ни одного предмета</h3>
<?php endif;?>