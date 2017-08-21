<?php 

use yii\helpers\Html; 
?>



<table class="table">
	<?php if($model != NULL): ?>
		<tr class="container-center-statistics-block-header">
			<td style="text-align: center;">#</td>
			<td>Название предмета</td>
			<td>Название темы</td>
			<td>Название типа</td>
			<td>Параметр оценивания</td>
			<td>Минимальный порог</td>
			<td>Действия</td>
		</tr>
	
		<?php if(!empty($model)): ?>
		<?php $i = 1; foreach($model as $m): ?>
			<tr>
				<td> <?=$i++?></td>
				<td><?= $m['subjName']?></td>
				<td><?= $m['themeName']?></td>
				<td><?= $m['typeName']?></td>
				<td><?= $m['evaName']?></td>
				<td style="text-align: center;"><?= $m['rating']?></td>
				<td>
					<?= Html::a('Удалить', ['/mentor/evaluation/delete', 'row_id' => $m['id']], ['class'=>'']) ?>
				</td>
			</tr>
		<?php endforeach;?>
		<?php endif;?>
	<?php else:?>
		<h2 class="non-options">В данный момент не назначено ни одного параметра</h2>
	<?php endif;?>
</table>

