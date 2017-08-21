<?php 

use yii\helpers\Html; 
?>
<?php $this->title = "ГУД | Ошибка";?>

<h3>Ошибка загрузки работы</h3>
<h4>Работа с номером варианта <?=$number_variant?> уже завершена</h4>
<h5>Узнать результаты теста Вы можете <?= Html::a(' здесь', ['/statistics/showone', 'number_variant' => $number_variant, 'user_id' => Yii::$app->user->getId()], ['class'=>'', 'id' => '']) ?></h5>