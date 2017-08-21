<?php 

use yii\helpers\Html; 
?>

<?php if($model != NULL): ?>
<table class="table" id="stat-table">

    <thead>
        <tr class="container-center-statistics-block-header">
            <td>Номер варианта</td> 		
            <td>Предмет</td>
            <td>Тема</td>
            <td style="width: 151px;">Дата прохождения</td>
            <td>Баллы</td>
            <td>Оценка</td>
            <td>Действие</td>
        </tr>
    </thead>

    <tbody class="container-center-statistics-block-tests">

    <?php if($model != NULL):  ?>

        <?php foreach($model as $m): ?>
            
    	   <tr style="background-color: <?= $m->background_color?>; ">
    	       <td style="text-align: left;"><?= $m->number_variant?></td>
    	       <td class = ""><?= $m->subject?></td>
               <td class = ""><?= $m->theme?></td>
    	       <td class = ""><?= date_create($m->date_begin)->Format('d.m.Y'); ?></td>
               <td class = ""><?= $m->mark?></td>
    	       <td class = ""><?= $m->textmark?></td>
    	       <td style="min-width: 118px;"><?= Html::a('Посмотреть', ['/statistics/showone', 'number_variant' => $m->number_variant], ['class' => '']) ?>
                  <?php if($m->is_viewed != 0): ?>
                       <b class = "is-viewed" title="Тест проверен преподавателем">✔</b>              
                   <?php endif; ?>
                   <?php if($m->has_comments ==1): ?>
                        <b class = "is-viewed" title="Оставлен новый комментарий">✉</b>   
                   <?php endif;?>
               </td>
    	   </tr>
    
	   <?php endforeach; ?> 

    <?php endif; ?>

	</tbody>

</table>

<?php else:?>
  <h1 class="non-search">Результаты поиска отсутствуют</h1>
<?php endif;?>


