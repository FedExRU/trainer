<?php 
	use yii\helpers\Html; 
?>
<?php $this->title = "ГУД | Параметры оценивания предмета";?>

<h2>Параметры оценивания предмета</h2>
<br />

<div class="eva-block" >

<?php if(!empty($subjects)):?>
	<table class="table">
		<tr class="container-center-statistics-block-header">
			<td>#</td>
			<td>Название предмета</td>
			<td>Минимальный процент выполненных работ по предмету</td>
			<td>Действия</td>
		</tr>
			<?php $i = 0; foreach($subjects as $subject): $i++?>
				<tr>
					<td class="tabel-eva-option"><?= $i?></td>
					<td class="tabel-eva-option"><?= $subject['name']?></td>
					<td class="tabel-eva-option"><?= $subject['rating'].'%'?></td>
					<td>
						<?= Html::a('Удалить', ['/mentor/evaluation/delete_evaluation_subject', 'row_id' => $subject['id']], ['class'=>'']) ?>
					</td>
				</tr>
			<?php endforeach;?>
	</table>

<?php else:?>
	<h2 class="non-options">В данный момент не назначено ни одного параметра</h2>
<?php endif;?>

</div>

<div class="eva-buttons-block">
	<?= Html::a('Добавить', ['/mentor/evaluation/create_evaluation_subject'], ['class'=>'main-menu-button-a']) ?>
	<a href="/mentor/evaluation/show" class="back-button-a">Назад</a>
</div>
