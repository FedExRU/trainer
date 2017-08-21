<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{

    public function actionIndex($creation = null, $data = null)
    {
    	\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 1);

        return $this->render('index', [
        	'creation' => $creation,
        	'data' => $data,
        ]);
    }
}
