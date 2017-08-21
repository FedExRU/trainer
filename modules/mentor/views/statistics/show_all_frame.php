<?php 

	use yii\helpers\Html;

?>


<?php if($model != NULL):?>
<table class="table">
	<tr class="container-center-statistics-block-header">
		<td >#</td>
		<td>Номер варианта</td>
		<td>Тема предмета</td>
		<td>Студент</td>
		<td>Баллы</td>
		<td>Оценка</td>
		<td>Дата прохождения</td>
		<td>Действия</td>
	</tr>
	
		<?php foreach($model as $m): ?>
			<?php if($m->is_viewed == 1): ?>
				<tr style="background-color: #9cff91;">
			<?php else:?>
				<tr style="background-color: #eee;">
			<?php endif;?>
				<td class="counter"></td>
				<td><?=$m->number_variant?></td>
				<td><?=$m->theme?></td>
				<td><?=$m->studentname?></td>
				<td style="text-align: center;"><?=$m->mark?></td>
				<td><?=$m->textmark?></td>
				<td><?=date_create($m->date)->Format('d.m.Y ')?></td>
				<td>
					<?= Html::a('Просмотр', ['/mentor/statistics/showone', 'number_variant' => $m->number_variant, 'user_id' => $m->user_id], ['class' => 'option']) ?> <br>
					<?php if($m->is_viewed == 0): ?>
						<?= Html::a('Отметить', ['/mentor/statistics/check', 'number_variant' => $m->number_variant], ['class' => 'option']) ?> <br>
					<?php endif; ?>
					<?= Html::a('Удалить', ['/mentor/statistics/delete', 'number_variant' => $m->number_variant], ['class' => 'option']) ?>
				</td>
			</tr>
		<?php endforeach;?>

	

</table>

<?php else:?>
	<h1 class="non-search">Результаты поиска отсутствуют</h1>
<?php endif;?>
