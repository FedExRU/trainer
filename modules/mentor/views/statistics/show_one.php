<?php 

use yii\helpers\Html; 
use yii\widgets\ActiveForm;

?>
<?php $this->title = "ГУД | Результат работы $model->number_variant";?>

<?php

$this->registerJs($list, yii\web\View::POS_LOAD);
?>

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
		<h5>Студент: <?= Html::a($model->studentname , ['/mentor/default/studentprofile' , 'user_id' => $model->user_id, 'subj_id' => $model->subj_id]) ?></h5>
	</div>
	<h3 class="container-center-statisics-one-heading">Результаты экзаменовки</h3>

	
	<div class="container-center-statisics-one-results">
	<table class="table" id="container-center-statisics-one-results-table">
		<tr class="container-center-log-heading">
			<td>#</td>
			<td>Вопрос</td>
			<td>Ответ</td>
		</tr>
		<?php for($i = 0; $i < count($answers['questions']); $i++): ?>
			 <tr style="background-color: <?= $answers['answers'][$i]->background_color?>; ">
			 	<td class = "container-center-statisics-one-results-table-option"><?= $i+1?></td>
				<td class = "container-center-statisics-one-results-table-option"><?= $answers['questions'][$i]->text?></td>
				<td class = "container-center-statisics-one-results-table-option"><?= $answers['answers'][$i]->text?></td>
			</tr>
		<?php endfor; ?>
		</table>
	</div>


	<h3 class="container-center-statisics-one-heading">Комментарии преподавателя</h3>
	<div class="container-center-statisics-one-commentaries">

		<?php $form = ActiveForm::begin([
    		'action' =>["comment/add", 'number_variant' => $model->number_variant, 'date' => date("y-m-d h:i:s"), 'user_id'=>$model->user_id ],
    		'method' => 'post',
    		'options' => [
    			'class' => 'comment-form',
    		]
    	]); ?>

    		<?=$form->field($comment_model, 'text')->textArea([
		    		'autofocus' => 'true',
		    		'placeholder' => 'Ваш комментарий...',
        			'class' => 'comment-field',
        			'id' => 'comment_field',
				])
       			->label(''); ?>

       		<?= Html::submitButton('Разместить', [
        		'id' => 'send-comment-button_id',
        		'class' => 'send-comment-button',
    			]); ?>

       	<?php ActiveForm::end() ?>

       	<div class="all-comments">
		<?php foreach ($comments as $comment): ?>
			<div class="comment-block">
				<div class="comment-block-text">
				<?= Html::a('✖' , ['/mentor/comment/delete', 'comment_id' => $comment->comment_id, 'number_variant' => $model->number_variant, 'user_id' => $model->user_id], ['title' => 'Удалить', 'class' => 'delete-icon']) ?>
					<b><?=$comment->text;?></b>
				</div>
				<div class="comment-block-time">
					<b><?=$comment->date;?></b>
				</div>
			</div>

		<?php endforeach; ?>
		</div>
		
	</div>
</div>

<a href="/mentor/statistics/showall?subj_id=<?=$subj_id?>" class="main-menu-button" id="back-button-satistics">Назад</a>