<?php

namespace app\controllers;

use Yii;
use app\models\AnswersResult;
use yii\web\Controller;

class ResultController extends Controller
{
    public function actionModerate($number_variant)
    {   
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 3);
    	$model = new AnswersResult($number_variant);
    	$model->attributes = Yii::$app->request->post('AnswersResult');
  
    	if($model->moderate() && $model->saveTest())
    		return $this->redirect(['succsess',
         	    'number_variant' => $number_variant,
            ]); 
    }

    public function actionSuccsess($number_variant)
    {
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 3);
        return $this->render('succsess', [
            'number_variant' => $number_variant,
        ]);
    }
}
