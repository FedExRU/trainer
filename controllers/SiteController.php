<?php

namespace app\controllers;

use Yii;
use app\models\Cathedras;
use app\models\Themes;
use app\models\Types;
use app\models\Log;
use app\models\Subjects;
use app\models\Profile;
use app\models\Groups_subjects;
use yii\web\Controller;


class SiteController extends Controller
{   
    public function actionIndex()
    {   
        if(Yii::$app->user->identity->role_id == 2)
            return $this->redirect(['/mentor']);
         if(Yii::$app->user->identity->role_id == 1)
            return $this->redirect(['/admin']);
        elseif(Yii::$app->user->isGuest)
            return $this->redirect(['/authorization/login']);

        $sampleSubjects = Groups_subjects::find()
            ->where(['group_number' => Yii::$app->user->identity->group_number])
            ->all();

        $subjects = Subjects::getSubjInfo($sampleSubjects);
            
        $themes = Themes::find()
            ->orderBy('name')
            ->all();

        $types = Types::find()
            ->orderBy('name')
            ->all();

        $cathedraInfo = Cathedras::getCathedraByGroupNumber(Yii::$app->user->identity->group_number);

        return $this->render('index', [
            'subjects' => $subjects,
            'themes' => $themes,
            'types' => $types,
            'cathedraInfo' => $cathedraInfo,
        ]);
    }

    public function actionContact()
    {
        return $this->render('contact');
    }

    public function actionGuide()
    {
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 3);
        return $this->render('guide');
    }

    public function actionProfile()
    {   
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 3);
        $userProfile = new Profile(Yii::$app->user->getId());

        return $this->render('profile', [
            'userProfile'=> $userProfile,
        ]);

    }

    public function actionHelp()
    {   
        return $this->render('help');
    }

}
