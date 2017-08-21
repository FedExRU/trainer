<?php 

use yii\helpers\Html;
use yii\helpers\NewLog;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
NewLog::setNewLogs();

if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}


$changeUserNamePositionBlock = <<< JS
   var a = $("div.user-name-menu").width(); 	
   var b = $("div.user-name-menu").offset();
   $(".user-name-menu-block").offset(b);
   $(".user-name-menu-block").offset({top:47});
JS;

$showUserNamePositionBlock = <<< JS
   $('#show').click(function(){
  		if ($('.user-name-menu-block').css('visibility') == 'hidden')
  		{
			$('.user-name-menu-block').css('visibility','visible');
		}	
		else 
		{
			$('.user-name-menu-block').css('visibility','hidden');
		}	
	});
JS;

$this->registerJs($changeUserNamePositionBlock, yii\web\View::POS_READY);
$this->registerJs($showUserNamePositionBlock, yii\web\View::POS_READY);
?>


<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

<div class="header">
	<div class="top-nav">
		<div class="top-nav-menu">
		<?php if(!Yii::$app->user->isGuest): ?>
			<?= Html::a('Главная', ['/site'], ['class' => 'top-nav-menu-option']) ?>
			<?= Html::a('Связаться с разработчиком', ['/site/contact'], ['class' => 'top-nav-menu-option']) ?>
			<?php if(Yii::$app->session->get('logCount') == 0): ?>
				<?= Html::a('Журнал событий', ['/log/show'], ['class' => 'top-nav-menu-option']) ?>
			<?php else:?>
				<?= Html::a('Журнал событий <b class = "is-viewed" title="Новое оповещение!">❶</b>', ['/log/show'], ['class' => 'top-nav-menu-option']) ?>
			<?php endif;?>
			<?= Html::a('Правила пользования', ['/site/guide'], ['class' => 'top-nav-menu-option']) ?>
			<b class="user-name">Добро пожаловать 
				<div class="user-name-menu"> 
					<?= Yii::$app->user->identity->last_name ?> <?= Yii::$app->user->identity->middle_name ?> <b id="show">▼</b>
				</div>
				<div class="user-name-menu-block" id="user-name-menu-block">
					<?= Html::a('Пройденные работы', ['/statistics/showall'], ['class' => 'user-name-menu-option']) ?>
					<?= Html::a('Статистика', ['/works/show'], ['class' => 'user-name-menu-option']) ?>
					<?= Html::a('Профиль', ['/site/profile'], ['class' => 'user-name-menu-option']) ?>
					<?= Html::a('Выйти', ['/authorization/logout'], ['class' => 'user-name-menu-option']) ?>
				</div>
			</b>	
		<?php else: ?>
			<div class="authRegBlock">
				<?= Html::a('Помощь', ['/site/help'], ['class' => 'top-nav-menu-option']) ?>
				<?= Html::a('Связаться с разработчиком', ['/site/contact'], ['class' => 'top-nav-menu-option']) ?>
				<?= Html::a('Авторизация', ['/authorization/login'], ['class' => 'top-nav-menu-option']) ?>
			</div>
		<?php endif; ?>
		</div>
	</div>
</div>

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>

<?php $this->beginBody() ?>

 	<div class="container-center">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>

<?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>