<?php $this->title = "ГУД | Общая статистика";?>

<h2>Общая статистика <?=$model['total']?> / 5</h2>

<div class="stat-fixed">

<?php if($model['subjects'] != NULL):?>

 	<div class="fixed">
 	<h4 class="nav-label">Навигация по статистике</h4>
		<ol>
		<?php foreach($model['subjects'] as $subjects): ?>
			<a href="#<?=$subjects['name']?>"><li><?=$subjects['name'] ?></li></a>	
		<?php endforeach;?>
		</ol>
 	</div>

<?php endif;?> 

<?php if($model['subjects'] != NULL):?>

 	<div class="fixed-less">
 	<h4 class="nav-less-label">Нав-я.</h4>
		<ol>
		<?php foreach($model['subjects'] as $subjects): ?>
			<a href="#<?=$subjects['name']?>"><li><?=$subjects['short_name'] ?></li></a>	
		<?php endforeach;?>
		</ol>
 	</div>

<?php endif;?> 

<?php if($model['subjects'] != NULL):?>

<?php foreach($model['subjects'] as $subjects): ?>

<div class="info">

	<a class="subj-label-a" href="" name="<?=$subjects['name']?>"><h3 class="subject-label">Отчет по предмету <?=$subjects['name'] ?></h3></a>

	<div class="subj-info">
	<?php if($model['themes'][$subjects['name']] !=NULL):?>
	<?php foreach($model['themes'][$subjects['name']] as $themes): ?>

			<h4 class="theme-label">Тема: <?= $themes['name']?></h4>

			<div class="theme-info">

				<?php if($model['types'][$subjects['name']][$themes['name']] != NULL):?>
				<?php foreach($model['types'][$subjects['name']][$themes['name']] as $types):?>

					<h4>Тип работы: <?=$types['name'] ?>. Тип оценивания: <?=$types['evaluation'] ?></h4>

					<div class="type-info">
					<ol>
						<?php if($model['result'][$subjects['name']][$themes['name']][$types['name']] != NULL):?>
						<?php foreach($model['result'][$subjects['name']][$themes['name']][$types['name']] as $result): ?>
							
								<li><h5>Работа с номером варианта <?=$result['number_variant']?>. Набранно баллов: <?=$result['mark']?></h5></li>
							
							
						<?php endforeach; ?>
						<?php endif;?>
						</ol>
					</div>
					<h4 class="works-average">Средняя оценка за работы: <?=$types['mark'] ?></h4>

				<?php endforeach;?>
			<?php endif;?>
		
			</div>
			<h4 class="theme-label">Средняя оценка по теме:  <?= $themes['mark']?></h4>
	<?php endforeach;?>
	<?php endif;?>
	</div>

<h3 class="subject-label">Средняя оценка по предмету: <?=$subjects['mark'] ?></h3>
</div>
	
<?php endforeach;?>
<?php endif;?> 

</div>

