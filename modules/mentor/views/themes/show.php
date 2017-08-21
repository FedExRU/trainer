<?php $this->title = "ГУД | Темы предмета"; ?>
<h2>Темы предмета <?= $subject?></h2> <br>
<?php use yii\helpers\Html; ?>
<?php if($themes !=NULL):?>

	<?php for($i = 0; $i < count($themes); $i++):?>
		<div class="subject-block-two">
			<h4 class="subject-block-label"><?=$themes[$i]->name?> <?= Html::a('✖' , ['/mentor/themes/delete', 'theme_id' => $themes[$i]->theme_id, 'subj_id' => $themes[$i]->subj_id], ['title' => 'Удалить', 'class' => 'delete-theme-icon', 'data' => ['confirm' => 'Удаление темы сопровождается удалением всех вопросов и ответов соответствующей темы. Вы уверены, что желаете удалить тему?']]) ?></h4>
			<div class="info-block">
				<div class="info-sub-block">
					<p class="info-text">Количество вопросов: <label> <?= $themesInfo[$i]['countQuestions']?></label>, из них</p> <br>
					<p class="info-text-third">Демо-примеров: <b><?= $themesInfo[$i]['countDemos']?></b></p> <br>
					<p class="info-text-third">Тестирований: <b><?= $themesInfo[$i]['countTest']?></b></p> <br>
					<p class="info-text-third">Практик: <b><?= $themesInfo[$i]['countPractice']?></b></p> 
					<br>
				</div>
				<div class="info-sub-block">
					<p class="info-text">Проходные баллы экзаменовки:</p> <br>
					<p class="info-text-third">Удовлетворительно:  <b><?= $themes[$i]->pass_mark ?></b></p> <br>
					<p class="info-text-third">Хорошо:  <b><?= $themes[$i]->dece_mark ?></b></p> <br>
					<p class="info-text-third">Отлично:  <b><?= $themes[$i]->exce_mark ?></b></p> <br> 
				</div>
			</div>
			<div class="subjects-buttons">
				<?= Html::a('Изменить', ['/mentor/themes/edit', 'theme_id' => $themes[$i]->theme_id, 'subj_id' => $themes[$i]->subj_id], ['class' => 'medium-button']) ?>
				<?= Html::a('Создать вопрос', ['/mentor/questions/create', 'theme_id' => $themes[$i]->theme_id], ['class' => 'medium-button']) ?>
				<?= Html::a('Подробнее...', ['/mentor/questions/show', 'theme_id' => $themes[$i]->theme_id], ['class' => 'medium-button']) ?>
			</div>
		</div>
	<?php endfor;?>

<?php else:?>
	<h3>В данный момент не создано ни одной темы</h3>
<?php endif;?>

<div style="width: 741px; height: 50px; margin-bottom: 20px;">
<?= Html::a('Создать тему', ['/mentor/themes/create', 'subj_id' => $themes[0]->subj_id], ['class'=>'main-menu-button-a']) ?>
<a href="/mentor" class="back-button-a">Назад</a>
</div>


