<?php

namespace app\modules\mentor\controllers;

use Yii;
use yii\web\Controller;
use app\models\Commentaries;
use app\models\Log;

class CommentController extends Controller
{
    public function actionAdd($number_variant, $date, $user_id)
    {	 
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
        $comments = new Commentaries();
        if($comments->add($number_variant, $_POST['Commentaries']['text'] ,$date, $user_id) && Log::commentWasAdded($number_variant, $user_id, $date))
        {
            return $this->redirect(['/mentor/statistics/showone', 'number_variant'=>$number_variant, 'user_id' => $user_id]);
        }
    }

    public function actionDelete($comment_id, $number_variant, $user_id)
    {
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
    	$comments = Commentaries::findOne($comment_id);
    	if($comments->delete())
    		return $this->redirect(['/mentor/statistics/showone', 'number_variant'=>$number_variant, 'user_id' => $user_id]);
    }
}
