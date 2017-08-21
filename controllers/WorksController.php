<?php

namespace app\controllers;

use app\models\Statistics;

use Yii;

class WorksController extends \yii\web\Controller
{
    public function actionShow()
    {
    	\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 3);
    	$model = Statistics::getTotalStatistics(Yii::$app->user->getId(), 'full');

    	return $this->render('show', ['model' => $model]);
    }

}
