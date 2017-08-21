<?php

namespace app\modules\mentor\controllers;

use Yii;
use yii\web\Controller;
use app\models\Mentors_subjects;
use app\models\Subjects;
use app\models\Themes;
use app\models\Statistics;
use app\models\Profile;
use app\models\Mentor_cathedras;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
        $sampleSubjects = Mentors_subjects::find()
            ->where(['mentor_id' => Yii::$app->user->getId()])
            ->all();

        $subjects = Subjects::getSubjInfo($sampleSubjects);

        $countThemes = Themes::getCountThemes($subjects, Yii::$app->user->getId());
        $countStatistics = Statistics::getCountStatistics($subjects, Yii::$app->user->getId());
        $cathedra = Mentor_cathedras::getShortName(Yii::$app->user->identity->mentor_cath);

        return $this->render('index', [
            'subjects' => $subjects,
            'countThemes' => $countThemes,
            'countStatistics' => $countStatistics,
            'cathedra' => $cathedra,
        ]);
    }

    public function actionStudentprofile($user_id, $subj_id)
    {   
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
        $userProfile = new Profile($user_id, 0, $subj_id);
        $userAverageSubject = Profile::getSubjectAverage($user_id, $subj_id);
        return $this->render('student_profile', [
            'userProfile'=> $userProfile,
            'userAverageSubject' => $userAverageSubject,
        ]);

    }
    
    public function actionContact()
    {
        
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
        return $this->render('contact');
    }

    public function actionGuide()
    {
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
        return $this->render('guide');
    }


    public function actionProfile()
    {
        $userProfile = new Profile(Yii::$app->user->getId(), 1);

        return $this->render('profile', [
            'userProfile' => $userProfile,
        ]);
    }

}
