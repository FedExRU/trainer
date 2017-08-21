<?php 
	use yii\helpers\Html; 
	use yii\helpers\ArrayHelper;
	use yii\widgets\ActiveForm;

?>
<?php $this->title = "ГУД | Журнал событий";?>

<h2>Журнал событий</h2>

<div class="container-center-log">
	<h4 class="container-center-log-new-main-heading">Новые</h4>
	<div class="container-center-log-new">
		<table class="table">
			<tr class="container-center-log-heading">
				<td>#</td>
				<td>Описание</td>
				<td>Дата</td>
				<td>Действия</td>
			</tr>
				<?php for ($i = 0; $i < count($newLog); $i++): ?>
					<tr>
						<td><?=$i+1?></td>
						<td><?=$newLog[$i]->text?></td>
						<td><?=$newLog[$i]->date?></td>
						<td>
							<?= Html::a('Отметить', ['/log/check', 'log_id' => $newLog[$i]->log_id]) ?>
							<?= Html::a('Удалить', ['/log/delete', 'log_id' => $newLog[$i]->log_id], ['class'=>'', 'id' => '']) ?>
						</td>
					</tr>
				<?php endfor; ?>
		</table>
	</div>
	<h4 class="container-center-log-new-main-heading">Просмотренные</h4>
	<div class="container-center-log-old">
		<table class="table">
			<tr class="container-center-log-heading">
				<td>#</td>
				<td>Описание</td>
				<td>Дата</td>
				<td>Действия</td>
			</tr>
			<?php for ($i = 0; $i < count($oldLog); $i++): ?>
				<tr>
					<td><?=$i+1?></td>
					<td><?=$oldLog[$i]->text?></td>
					<td><?=$oldLog[$i]->date?></td>
					<td><?= Html::a('Удалить', ['/log/delete', 'log_id' => $oldLog[$i]->log_id], ['class'=>'', 'id' => '']) ?></td>
				</tr>
			<?php endfor; ?>
		</table>
	</div>
	<div class="container-center-log-buttons">
		<?= Html::a('Отметить все', ['/log/checkall', 'user_id' => Yii::$app->user->getId()], ['class'=>'main-menu-button', 'id' => 'check-log-button']) ?>
		<?= Html::a('Назад', ['/site/index'], ['class'=>'main-menu-button', 'id' => 'back-button-satistics']) ?>
	</div>

</div>