<?php

namespace app\modules\mentor\controllers;

use Yii;
use app\models\Log;
use app\models\Logunits;
use yii\web\Controller;

class LogController extends Controller
{
   public function actionShow()
   {	
      \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
   	$newLog = Log::find()
   		->where([
   			'user_id' => Yii::$app->user->getId(),
   			'is_viewed' => '0'
   		])
   		->all();    

   	$oldLog = Log::find()
   		->where([
   			'user_id' => Yii::$app->user->getId(),
   			'is_viewed' => '1'
   		])
   		->all();    

   	return $this->render('show', [
   	    'newLog' => $newLog, 
   	    'oldLog' => $oldLog,    
   	]);
   }

   public function actionCheck($log_id)
   {
      \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
   	if(Log::checkLog($log_id))
   		return $this->redirect(['/mentor/log/show']);
   }

   public function actionCheckall()
   {
      \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
   	if(Log::checkAll(Yii::$app->user->getId()))
   	{
         return $this->redirect(['/mentor/log/show']);
      }
   }

   public function actionDelete($log_id)
   {  
      \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
   	if(Log::deleteLog($log_id))
   		return $this->redirect(['/mentor/log/show']);
   }

}
