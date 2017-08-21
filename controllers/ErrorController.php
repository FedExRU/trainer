<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;

class ErrorController extends Controller
{
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception != null) {
            if ($exception instanceof HttpException) {
                return $this->redirect(['/error/notfound404'])->send();
            }
        }
        return $this->render('error',['exception' => $exception]);
    }

    public function actionNotfound404()
    {
    	return $this->renderPartial('404');
    }

}
