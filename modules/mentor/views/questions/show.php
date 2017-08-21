<?php 
	use yii\helpers\Html;
?>

<?php 

$list = <<< JS
    $("h3.container-center-themes-subject-label-two").click(function(){
    	$(this).next().slideToggle();
    	if($(this).find('#subj-arrow').text() == '▼')
    		$(this).find('#subj-arrow').text('▲');
    	else
    		$(this).find('#subj-arrow').text('▼');
    });
JS;

$this->registerJs($list, yii\web\View::POS_READY);

$answerList = <<< JS
    $("b.show-answers").click(function(){
    	$(this).next().slideToggle();
    	if($(this).text() == 'Показать ответы')
    		$(this).text('Скрыть ответы');
    	else
    		$(this).text('Показать ответы');
    });
JS;

$this->registerJs($answerList, yii\web\View::POS_READY);
?>

<?php $this->title = "ГУД | Реестр вопросов"; ?>
<h3 style="margin-bottom: 40px;"> Реестр вопросов по теме <?= $theme?> предмета <?= $subject?></h3>

<h3 class="container-center-themes-subject-label-two"><label class="type-name">Демо-примеры <b>(<?= count($demos)?>)</b></label><b id="subj-arrow">▼</b></h3>
<div class="total-question-block">
	<?php if($demos != NULL):?>
		<?php foreach($demos as $d): ?>
			<div class="answer-question-block">
			<div class = "questions-block">
				<b>Идентификатор: #<?=$d->question_id ?></b><br>
				<b>Текст:</b>
				<?php if($d->picture != NULL):?>
					<img src="<?= $d->picture?>" class="question-picture-two">
				<?php else:?>
					<img src="/img/another/default.png" class="question-picture-two">
				<?php endif;?>
				<p><?= $d->text?></p>
				<div class="questions-options">
					<?= Html::a('Удалить', ['/mentor/questions/delete', 'question_id' => $d->question_id, 'theme_id' => $d->theme_id], ['class' => 'show-answers']) ?>
				</div>
			</div>
			</div>
		<?php endforeach;?>
	<?php endif;?>
</div>

<h3 class="container-center-themes-subject-label-two"><label class="type-name">Тестирование <b>(<?= count($tests)?>)</b></label><b id="subj-arrow">▼</b></h3>
<div class="total-question-block">
	<?php if($tests != NULL):?>
		<?php foreach($tests as $t): ?>
			<div class="answer-question-block"> 
			<div class = "questions-block">
				<b>Идентификатор: #<?=$t->question_id ?></b><br>
				<b>Текст:</b>
				<?php if($t->picture != NULL):?>
					<img src="<?= $t->picture?>" class="question-picture-two">
				<?php else:?>
					<img src="/img/another/default.png" class="question-picture-two">
				<?php endif;?>
				<p><?= $t->text?></p>
			</div>
			<?= Html::a('Удалить', ['/mentor/questions/delete', 'question_id' => $t->question_id, 'theme_id' => $t->theme_id], ['class' => 'show-answers']) ?>
			<b class="show-answers">Показать ответы</b>
			<div class="answer-block">
				<?php if($answers['tests']!=NULL):?>
					<?php foreach($answers['tests'] as $ap):?>
						<?php if($ap[0]->question_id == $t->question_id):?>
							<?php foreach($ap as $a):?>
								<?php if($a->is_correct == 1):?>
									<p class = "answer-value" style="background-color: #9cff91"><?=$a->text?></p>
								<?php else:?>
									<p class = "answer-value"><?=$a->text?></p>
								<?php endif;?>
							<?php endforeach;?>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
			</div>
			</div>
		<?php endforeach;?>
	<?php endif;?>
</div>

<h3 class="container-center-themes-subject-label-two"><label class="type-name">Практика <b>(<?= count($practice)?>)</b></label><b id="subj-arrow">▼</b></h3>
<div class="total-question-block">
	<?php if($practice != NULL):?>
		<?php foreach($practice as $p): ?>
			<div class="answer-question-block"> 
			<div class = "questions-block">
				<b>Идентификатор: #<?=$p->question_id ?></b><br>
				<b>Текст:</b>
				<?php if($p->picture != NULL):?>
					<img src="<?= $p->picture?>" class="question-picture-two">
				<?php else:?>
					<img src="/img/another/default.png" class="question-picture-two">
				<?php endif;?>
				<p><?= $p->text?></p>
			</div>
			<?= Html::a('Удалить', ['/mentor/questions/delete', 'question_id' => $p->question_id, 'theme_id' => $p->theme_id], ['class' => 'show-answers']) ?>
			<b class="show-answers">Показать ответы</b>
			<div class="answer-block">
				<?php if($answers['practice']!=NULL):?>
					<?php foreach($answers['practice'] as $ap):?>
						<?php if($ap[0]->question_id == $p->question_id):?>
							<?php foreach($ap as $a):?>
								<p class = "answer-value" style="background-color: #9cff91"><?=$a->text?></p>
							<?php endforeach;?>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
			</div>
			</div>
		<?php endforeach;?>
	<?php endif;?>
</div> 

<div style="margin-right: 63px; margin-bottom: 10px; height: 50px; margin-top: 15px; display: inline-block; float: right;">
<?= Html::a('Создать вопрос', ['/mentor/questions/create', 'theme_id' => $theme_id], ['class'=>'main-menu-button-a']) ?>
<a href="/mentor/themes/show?subj_id=<?=$subj_id?>" class="back-button-a">Назад</a>
</div>




