<?php 
use yii\helpers\Html; 
use yii\helpers\Url;
?>
<?php $this->title = "ГУД | Профиль студента ".$userProfile->privateUserInfo->first_name; ?>


<h2>Профиль студента</h2>
<h4><?= $userProfile->privateUserInfo->first_name ?> <?= $userProfile->privateUserInfo->last_name ?> <?= $userProfile->privateUserInfo->middle_name ?></h4>
<div class="container-center-user-data">
	<div class="container-center-user-data-main-info">
		<h4 class = "container-center-user-data-main-info-labels">Факультет: <b class = "container-center-user-data-main-values"><?= $userProfile->faculcyInfo->name?></b></h4> 
		<h4 class = "container-center-user-data-main-info-labels">Направление: <b class = "container-center-user-data-main-values"><?= $userProfile->cathedraInfo->name?></b></h4>
		<h4 class = "container-center-user-data-main-info-labels">Группа: <b class = "container-center-user-data-main-values"><?= $userProfile->privateUserInfo->group_number ?></b></h4> 
	</div>
	<div class="container-center-user-data-another-info">
		<h4 class="container-center-user-data-another-info-labels">Дата регистрации: <b class="another-labels-value"><?php $date = new DateTime($userProfile->privateUserInfo->date ); echo $date->format('d.m.Y') ?></b></h4>
		<h4 class="container-center-user-data-another-info-labels">Количество авторизаций в Системе: <b class="another-labels-value"><?= $userProfile->privateUserInfo->hits ?></b></h4>
		<h4 class="container-center-user-data-another-info-labels">Количество пройденных экзаменовок: <b class="another-labels-value"><?= $userProfile->countTest ?></b> <br/>из них:</h4>
		<div class="container-center-user-data-another-info-marks">
			<h5 class="container-center-user-data-another-info-marks-values">Неудовлетворительно: <b class="container-center-user-data-another-info-marks-values-marks"><?= $userProfile->marks['non_pass_mark'] ?></b> </h5>
			<h5 class="container-center-user-data-another-info-marks-values">Хорошо: 			  <b class="container-center-user-data-another-info-marks-values-marks"><?= $userProfile->marks['dece_mark'] ?></b></h5>
			<h5 class="container-center-user-data-another-info-marks-values">Удовлетворительно:   <b class="container-center-user-data-another-info-marks-values-marks"><?= $userProfile->marks['pass_mark'] ?></b> </h5>
			<h5 class="container-center-user-data-another-info-marks-values">Отлично: 			  <b class="container-center-user-data-another-info-marks-values-marks"><?= $userProfile->marks['exce_mark'] ?></b> </h5>
		</div>
		<h4 class="container-center-user-data-another-info-labels">Средний балл по работам: <b class="another-labels-value"><?= round($userProfile->average, 2)?></b></h4>
		<h4 class="container-center-user-data-another-info-labels">Средний балл по предмету: <b class="another-labels-value"><?= round($userAverageSubject, 2)?></b></h4>
	</div>
</div>
<a href="javascript:history.back();" class="main-menu-button" id="back-button-satistics">Назад</a>