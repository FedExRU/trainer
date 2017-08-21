<?php

namespace app\controllers;

use Yii;
use app\models\Log;
use app\models\StatisticsInfo;
use app\models\Results;
use app\models\Commentaries;
use yii\web\Controller;
use app\models\Types;
use app\models\Themes;
use app\models\Subjects;

class StatisticsController extends Controller
{
    public function actionShowall()
    {
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 3);
        //$model = StatisticsInfo::getBaseInfo(Yii::$app->user->getId());

        $subjects = Subjects::getArraySubjects(); 
        $types = Types::getArrayTypes();
        $themes = Themes::getArrayThemes($subjects);

        return $this->render('show_all', [
            'subjects' => $subjects,
            'types' => $types,
            'themes' => $themes,
            //'model' => $model,
        ]);
    }

    public function actionShowframe($subj_id, $type_id, $theme_id)
    {
        if($subj_id == 'null')
            $subj_id = null;

        if($theme_id == 'null')
            $theme_id = null;

        if($type_id == 'null')
            $type_id = null;

        $model = StatisticsInfo::getBaseInfo(Yii::$app->user->getId(), $subj_id, $type_id, $theme_id);

        return $this->renderPartial('show_frame',[
            'model' => $model,
        ]);
    }

    public function actionShowone($number_variant)
    {   
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 3);
        $model = StatisticsInfo::getAllInfo($number_variant, Yii::$app->user->getId());

        $answers = Results::getAnswers($number_variant);

        $comments = Commentaries::find()
            ->where(['number_variant' => $number_variant])
            ->all();

        if(Log::unsetCommentsNotice($number_variant, Yii::$app->user->getId()))
        {
            return $this->render('show_one', [
                'model' => $model,
                'comments' => $comments,
                'answers' => $answers,
            ]);
        }
    }
}
