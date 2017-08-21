<?php 

	use yii\helpers\Html;
	use yii\helpers\ModalWindow;
	//ModalWindow::createWindow();
?>

<?php 
	$show_modal = <<< JS
   $('#modal').modal('show');
JS;

$this->registerJs($show_modal, yii\web\View::POS_LOAD);
?>

<?php $this->title = 'ГУД | Реестр предметов'; ?>

<h2>Реестр предметов</h2>

<section class="subjects-info">
	<h4>Количество предметов: <?=$subjects['total_info']['count_subjects']?> </h4>
	<h4>Последний добавленный предмет: <?=$subjects['total_info']['last_added_subject'] ?></h4>
</section>

<section class = "subjects-list">
	<table class="table">
		<tr class="container-center-statistics-block-header">
			<td>#</td>
			<td>Название предмета</td>
			<td>Факультет</td>
			<td>Действия</td>
		</tr>
		<?php if(!empty($subjects['private_info'])):?>
			<?php $i = 1; foreach($subjects['private_info'] as $subject):?>
				<tr>
					<td><?=$i?></td>
					<td><?=$subject['subject_name']?></td>
					<td><?=$subject['faculcy_name']?></td>
					<td>
						<?= Html::a('Оповестить об удалении', '/admin', ['class' => '']) ?>
						<?= Html::a('Удалить', '/admin', ['class' => '']) ?>
					</td>
				</tr>
			<?php $i++; endforeach;?>
		<?php else: ?>
			<h3 class="non-subjects">В данный момент не добавлено ни одного предмета!</h3>
		<?php endif;?>

	</table>
</section>

<section class="nav-buttons">
<?= Html::a('Назад', ['/site/index'], ['class'=>'main-menu-button', 'id' => 'back-button-satistics']) ?>
</section>