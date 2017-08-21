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
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

<div class="header">
	<div class="top-nav" id="admin">
		<div class="top-nav-menu">

			<?= Html::a('Главная', '/admin', ['class' => 'top-nav-menu-option']) ?>
			<?= Html::a('Связаться с разработчиком', ['/site/contact'], ['class' => 'top-nav-menu-option']) ?>
			<?= Html::a('Список преподавателей', ['/site/guide'], ['class' => 'top-nav-menu-option']) ?>
			<?= Html::a('Реестр предметов', ['/admin/subjects/show'], ['class' => 'top-nav-menu-option']) ?>
			<?= Html::a('Администрирование студентов', ['/site/guide'], ['class' => 'top-nav-menu-option']) ?>
			<?= Html::a('Правила пользования', ['/site/guide'], ['class' => 'top-nav-menu-option']) ?>
			<?= Html::a('Контакты', ['/site/guide'], ['class' => 'top-nav-menu-option']) ?>
			<?= Html::a('Выйти', ['/site/guide'], ['class' => 'top-nav-menu-option']) ?>
			
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