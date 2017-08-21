<?php 

use yii\helpers\Html; 

?>
<?php $this->title = "ГУД | Результат работы $model->number_variant";?>

<div class="container-center-heading">
	<h3>Результат прохождения варианта <?= $model->number_variant ?></h3>
</div>

<div class="container-center-statisics-one">
	<h3 class="container-center-statisics-one-heading">Общая информация</h3>
	<div class="container-center-statisics-one-text">
		<h5>Тип экзаменовки: <?= $model->type ?> </h5>
		<h5>Набрано баллов: <?= $model->mark ?> из <?= $model->maxMark ?></h5>
		<h5>Предмет экзаменовки: <?= $model->subject ?></h5>
		<h5>Оценка: <?= $model->textmark ?></h5>
		<h5>Тема предмета: <?= $model->theme ?> </h5>
		<h5>Дата прохождения: <?= date_create($model->date_begin)->Format('d.m.Y'); ?></h5>
		<h5>Время прохождения: <?php $date = strtotime($model->date_end) - strtotime($model->date_begin); echo date('i:s',$date); ?></h5>
		<h5>Преподаватель: <?= $model->mentor ?></h5>
	</div>
	<h3 class="container-center-statisics-one-heading">Результаты экзаменовки</h3>

	<?php if($model->is_viewed == 0): ?>
		<div class="container-center-statisics-one-results-none">
			<h3 class="container-center-statisics-one-results-none-notification">Результаты не доступны. Преподаватель не проверил тест</h3>
		</div>
	<?php else: ?>
		<div class="container-center-statisics-one-results">
		<table class="table" id="container-center-statisics-one-results-table">
			<tr class="container-center-log-heading">
				<td>#</td>
				<td>Вопрос</td>
				<td>Ответ</td>
			</tr>
			<?php for($i = 0; $i < count($answers['questions']); $i++): ?>
				 <tr style="background-color: #dee; ">
				 	<td class = "container-center-statisics-one-results-table-option"><?= $i+1?></td>
					<td class = "container-center-statisics-one-results-table-option"><?= $answers['questions'][$i]->text?></td>
					<td class = "container-center-statisics-one-results-table-option"><?= $answers['answers'][$i]->text?></td>
				</tr>
			<?php endfor; ?>
			</table>
		</div>
	<?php endif; ?>

	<h3 class="container-center-statisics-one-heading">Комментарии преподавателя</h3>
	<div class="container-center-statisics-one-commentaries">

	<?php if($comments == NULL): ?>
			<h3 class="container-center-statisics-one-commentaries-none-notification">Еще не оставленно ни одного комментария</h3>
	<?php else: ?>
		<?php foreach ($comments as $comment): ?>
			<div class="comment-block">
				<div class="comment-block-text">
					<b><?=$comment->text;?></b>
				</div>
				<div class="comment-block-time">
					<b><?=$comment->date;?></b>
				</div>
			</div>

		<?php endforeach; ?>
	<?php endif; ?>

	</div>
</div>

<?= Html::a('Назад', ['/statistics/showall', 'user_id' => $model->user_id], ['class'=>'main-menu-button', 'id' => 'back-button-satistics']) ?>

