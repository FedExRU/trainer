<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\SubjectConfig;
use app\models\Faculties;

class SubjectsController extends Controller
{

    public function actionCreate()
    {
    	\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 1);

    	$model = new SubjectConfig();
    	$array_faculcy = Faculties::getArrayFaculcy();

    	if(Yii::$app->request->post('SubjectConfig'))
    	{
    		$model->attributes = Yii::$app->request->post('SubjectConfig');
    		
    		if($model->validate() && $model->save())
    			return $this->redirect(['/admin', 
                    
                ]);
    	}

        return $this->render('create', [
        	'model' => $model,
        	'array_faculcy' => $array_faculcy,
        ]);
    }

    public function actionShow()
    {
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 1);

        $subjects = SubjectConfig::getSubjectInfo();

        return $this->render('show', [
            'subjects' => $subjects,
        ]);
    }
}
