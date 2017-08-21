
<?php 
	use yii\helpers\Html;
	use app\models\User;
?>

<table class="table">
		<tr>
			<td class="group-stat-heading"><br />#</td>
			<td class="group-stat-heading"><br /><label id="center">ФИО студента</label></td>
			<?php if($groupStat['works'] != NULL):?>
				<?php foreach($groupStat['works'] as $work): ?>
					<td class="group-stat-heading">
						<img src = '/img/another/exclamation-point11-white.png' class = 'notice' id="group-res" title = 'Тип оценивания: <?=$work['eva_name'] ?>'><?= Html::a($work['name'].": <br>".$work['type'], [
						'/mentor/statistics/showall' , 
						'subj_id' => $subj_id, 
						'user_id' => null, 
						'theme_id'=> $work['theme_id'], 
						'type_id' => $work['type_id']]) 
						?>

					</td>
				<?php endforeach;?>
			<?php else:?>
				<td class="group-stat-heading"><br />В данный момент группой не пройдено ни одной темы</td>
			<?php endif;?>
			<td class="group-stat-heading"><br />Средняя оценка</td>
			<td class="group-stat-heading"><br />Действия</td>

		</tr>
		<?php if($groupStat['students'] != NULL): ?>
		<?php for($i = 0; $i < count($groupStat['students']); $i++): ?>
				
			<tr>
				<td class="group-stat-heading"><?=$i+1?></td>

				<td class="group-stat-heading">
					<?= Html::a(User::getStudentName($groupStat['students'][$i]->user_id), [
						'/mentor/default/studentprofile' , 
						'user_id' => $groupStat['students'][$i]->user_id, 
						'subj_id' => $subj_id],
						[
							'class' => 'username-stat',
						]) 
					?>	
				</td>

				<?php for($j=0; $j <count($groupStat['works']); $j++):?>
					<td class="stat-value" style="background-color: <?= $statValues[$i]['private']['color'][$j]?>">
						<?= Html::a($statValues[$i]['private']['value'][$j], [
						'/mentor/statistics/showall' , 
						'subj_id' => $subj_id, 
						'user_id' => $groupStat['students'][$i]->user_id, 
						'theme_id'=> $groupStat['works'][$j]['theme_id'], 
						'type_id' => $groupStat['works'][$j]['type_id']]) 
						?>
					</td>
				<?php endfor;?>
				<?php if(count($groupStat['works'])!=NULL):?>
					<td class="stat-value" style="background-color: <?=$statValues[$i]['total']['color']?>"><?=$statValues[$i]['total']['value']?> <?=$statValues[$i]['total']['status']?></td>
				<?php else:?>
					<td class="stat-value"></td>
					<td class="stat-value"></td>
				<?php endif;?>
				<td class="options-value"><?= Html::a('Посмотреть работы', ['/mentor/statistics/showall' , 'subj_id' => $subj_id, 'user_id' => $groupStat['students'][$i]->user_id]) ?></td>
			</tr>

		<?php endfor;?>
		<?php else:?>
			<td></td>
			<td>В группе не указанно ни одного студента</td>
			<td></td>
			<td></td>
			<td></td>
		<?php endif;?>

	</table>
