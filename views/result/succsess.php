<?php 

use yii\helpers\Html; 
?>
<?php $this->title = "ГУД | Завершение работы";?>

<h3 class = "succsess-labels">Успешная экзаменация</h3>
<h4 class = "succsess-labels">Работа с номером варианта <?=$number_variant?> завершена</h4>
<h5>Узнать результаты Вы можете <?= Html::a(' здесь', ['/statistics/showone', 'number_variant' => $number_variant, 'user_id' => Yii::$app->user->getId()], ['class'=>'', 'id' => '']) ?></h5>