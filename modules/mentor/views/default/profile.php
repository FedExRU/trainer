<?php use yii\helpers\Html; ?>
<?php $this->title = "ГУД | Профиль";?>


<h2>Профиль преподавателя</h2>
<h4><?= $userProfile->privateUserInfo->first_name ?> <?= $userProfile->privateUserInfo->last_name ?> <?= $userProfile->privateUserInfo->middle_name ?></h4>

<div class="container-center-user-data" id="mentor-info">
	<div class="container-center-user-data-main-info" id="mentor-stat">
		<h4 class = "container-center-user-data-main-info-labels">Кафедра: <b class = "container-center-user-data-main-values"><?= $userProfile->mentorCathedraInfo ?></b></h4> 
		<h4 class = "container-center-user-data-main-info-labels">Идентификатор: <b class = "container-center-user-data-main-values">#M<?= $userProfile->privateUserInfo->user_id ?></b></h4> 
	</div>
	<div class="container-center-user-data-another-info">
		<h4 class="container-center-user-data-another-info-labels">Дата регистрации: <b class="another-labels-value"><?php $date = new DateTime($userProfile->privateUserInfo->date ); echo $date->format('d.m.Y') ?></b></h4>
		<h4 class="container-center-user-data-another-info-labels">Количество авторизаций в Системе: <b class="another-labels-value"><?= $userProfile->privateUserInfo->hits ?></b></h4>
		<h4 class="container-center-user-data-another-info-labels">Пройденных экзаменовок<br> по предметам: <b class="another-labels-value"><?= $userProfile->countStat?></b></h4>
		<h4 class="container-center-user-data-another-info-labels">Создано тем: <b class="another-labels-value"><?= $userProfile->countThemes?></b></h4>
		<h4 class="container-center-user-data-another-info-labels">Создано вопросов по темам: <b class="another-labels-value"><?= $userProfile->countQuestions?></b></h4>
		<h4 class="container-center-user-data-another-info-labels">Эффективность в Системе: <b class="another-labels-value"><?= $userProfile->efficiency?></b></h4>
	</div>
</div>
<?= Html::a('Назад', ['/mentor'], ['class'=>'main-menu-button', 'id' => 'back-button-satistics']) ?>