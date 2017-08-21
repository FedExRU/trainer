<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php $this->title = "ГУД | ".$info['type']." ".$info['number_variant'];?>

<h3 class = "info-line"><?= $info['type'] ?> по теме <?= $info['theme'] ?> предмета <?= $info['subject'] ?></h3>

<?php if($info['number_variant'] != NULL): ?>
   <h4 class = 'number_variant'>Вариант №<?=$info['number_variant']?> </h4> 
<?php else: ?>
  <br>
<?php endif; ?>

<?php if($info['type_id'] == 4): ?>
  <div class="timer">
      <b class="notifier">До конца работы осталось:</b>
      <span id="my_timer" class="timer-ticks"><?=$info['test_date'] ?></span>
  </div>
<?php endif;?>


<?php 

$timerStart = <<< JS
    startTimer(); 
JS;

$parseTime_bv = "
 function startTimer() {
    var my_timer = document.getElementById('my_timer');
    var time = my_timer.innerHTML;
    var arr = time.split(':');
    var m = arr[0];
    var s = arr[1];
    if (s == 0) {
      if (m == 0) {
          alert('Время вышло');
          var url = '/result/moderate?number_variant=".$info['number_variant']."';
          $.post(url, { ref: 'asd'}, function() {
            location.href = url;
        });
      }
      m--;
      if (m < 10) m = '0' + m;
      s = 59;
    }
    else s--;
    if (s < 10) s = '0' + s;
    document.getElementById('my_timer').innerHTML = m+':'+s;
    setTimeout(startTimer, 1000);
  }";

$this->registerJs($parseTime_bv, yii\web\View::POS_LOAD);
$this->registerJs($timerStart, yii\web\View::POS_LOAD);

?>

<?php $form = ActiveForm::begin([
    'action' =>["result/moderate", 'number_variant' => $info['number_variant']],
    'method' => 'post',
    ]); 

?>
<div class="questions-fixed">


<div class="question-nav">

<label>Навигация</label>
<?php if($info['number_variant'] != NULL): ?>
  <?php for ($i=0; $i < count($questions); $i++): ?>

    <a href="#<?= ($i+1)?>"><p>Вопрос № <?= ($i+1)?></p></a>
  <?php endfor;?>
<?php else:?>
   <?php for ($i=0; $i < count($questions); $i++): ?>

    <a href="#<?= ($i+1)?>"><p>Демо-пример # <?= ($i+1)?></p></a>
  <?php endfor;?>
<?php endif;?>

</div>

<?php 
  
  if(count($questions) == 0)
  {
    echo "<h3>На данный момент не подготовленно ни одного вопроса</h3>"; 
  }
  else
  {
  for ($i=0; $i < count($questions); $i++) 
  {   

    echo "<div class = question-div>";

    echo "<div class = 'question-top'>";
    if($info['number_variant'] != NULL)
      echo "<a class = 'question-anchor' name = '".($i+1)."'><h4 class = 'text-question'> Вопрос № ".($i+1)."</h4></a>";
    else
      echo "<a class = 'question-anchor' name = '".($i+1)."'><h4 class = 'text-question'> Демо-пример # ".($i+1)."</h4></a>";

    echo "<h4 class = 'text-question'>".$questions[$i]->text."</h4>";

    if($info['number_variant'] != NULL)
        echo $form->field($model, 'testQuestionsId['.$i.']')->textInput(['class' => 'secret', 'value' => ''.$questions[$i]->question_id.''])->label(FALSE);

    if($questions[$i]->picture != NULL)
        echo "<img src='".$questions[$i]->picture."' class='question-picture'>";

    echo "</div>";
    if($answers[$i] != NULL)
    {    
        echo "<div class = answer-div>";
        if($answers[$i][0]->input_type=="radio")
         {   
            echo $form->field($model, 'answers['.$i.']')
                ->radioList(ArrayHelper::map($answers[$i], 'answer_id', 'text'), [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return
                        '<div class="radio"><label>' . Html::radio($name, $checked, ['value' => $value]) . $label . '</label></div>';
                    },
                    'class' => 'test-answers-group',
                ])
                ->label(FALSE);        
         }

         elseif($answers[$i][0]->input_type=="checkbox")
         {  
        	echo $form->field($model, 'answers['.$i.']')
                ->checkboxList(ArrayHelper::map($answers[$i], 'answer_id', 'text'), [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return
                        '<div class="radio"><label>' . Html::checkbox($name, $checked, ['value' => $value]) . $label . '</label></div>';
                    },
                    'class' => 'test-answers-group',
                ])
                ->label(FALSE);       
         }
         else
         {  
            echo $form->field($model, 'answers['.$i.']')->textInput(['placeholder' => 'Ваш ответ...', 'class' => 'text-answer-field'])->label(FALSE);
         }
    
        echo "<br/>";
        echo "</div>";
    }

    echo "</div>";
  }
  }

  ?>
  </div>
  <div class="test-buttons-block">
  <?php if($info['number_variant'] != NULL && count($questions) != 0):?>
      <?=Html::submitButton('Завершить', ['class' => 'main-menu-button', 'id' => 'end-test-button'])?>
  <?php endif; ?>
  <?= Html::a('Назад', ['/site/index'], ['class'=>'main-menu-button', 'id' => 'back-button-satistics']) ?>
  </div> 

<?php ActiveForm::end() ?>