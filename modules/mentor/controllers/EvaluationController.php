<?php

namespace app\modules\mentor\controllers;

use Yii;
use yii\web\Controller;
use app\models\Evaluation_works;
use app\models\EvaluationConfig;
use app\models\Subjects;
use app\models\Types;
use app\models\Themes;
use app\models\Evaluation;
use app\models\Evaluation_subjects;

class EvaluationController extends Controller
{

    public function actionShow()
    {
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
        return $this->render('show');
    }

    public function actionThemes_evaluation()
    {
    	\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);

    	/*$query = Evaluation_works::find()
    		->where(['mentor_id' => Yii::$app->user->getId()])
    		->orderby('row_id DESC')
    		->all();

    	$model = EvaluationConfig::getTextNames($query); */

    	$subjects = Subjects::getArraySubjects('evaluation');
    	$types = Types::getArrayTypes();
    	$themes = Themes::getArrayThemes($subjects); 

        return $this->render('show_themes_evaluation', [
        	//'model' => $model,
        	'subjects' => $subjects,
        	'themes' => $themes,
        	'types' => $types,
        ]);
    }

    public function actionSubjects_evaluation()
    {
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);

        $subjects = Evaluation_subjects::getMySubjects();

        return $this->render('show_subjects_evaluation', [
            'subjects' => $subjects,
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

        $model = Evaluation_works::getInfo($subj_id, $type_id, $theme_id);

        return $this->renderPartial('show_frame',[
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
    	\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);

    	$model = new EvaluationConfig();

    	$subjects = Subjects::getNonSetedEVASubjects();
    	$types = Types::getArrayTypes();
    	$evaTypes = Evaluation::find()->orderby('name')->all();

    	if(Yii::$app->request->post())
    	{
    		$model->attributes = Yii::$app->request->post('EvaluationConfig');
    		$model->rating = $_POST['slider'];

    		if($model->validate() && $model->save())
            {   
                return $this->redirect([
                	'/mentor/evaluation/themes_evaluation',
                ]);
                
            }      	
    	}

    	return $this->render('create', [
    		'model' => $model,
    		'subjects' => $subjects,
    		'types' => $types,
    		'evaTypes' => $evaTypes,
    	]);
    }

    public function actionCreate_evaluation_subject()
    {
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);

        $model = new EvaluationConfig();
        $subjects = Evaluation_subjects::getNonSettedSubjectsArray();

        if(Yii::$app->request->post())
        {
            $model->attributes = Yii::$app->request->post('EvaluationConfig');
            $model->rating = $_POST['slider'];


            if($model->validate(['subj_id']) && $model->saveForSubject())
            {   
                return $this->redirect([
                    '/mentor/evaluation/subjects_evaluation',
                ]);
                
            }       
        }

        return $this->render('create_evaluation_subject', [
            'model' => $model,
            'subjects' => $subjects,
        ]);
    }

    public function actionDelete_evaluation_subject($row_id)
    {
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);

        $model = Evaluation_subjects::findOne($row_id);

        $model->delete();

         return $this->redirect([
            '/mentor/evaluation/subjects_evaluation',
        ]);
    }

    public function actionDelete($row_id)
    {
    	\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);

    	$model = Evaluation_works::findOne($row_id);

    	$model->delete();

    	return $this->redirect([
        	'/mentor/evaluation/themes_evaluation',
        ]);

    }

    public function actionShowthemes($subj_id)
    {
        $themesList = Themes::find()
            ->where(['subj_id'=>$subj_id])
            ->all();

        if(!empty($themesList))
        {
            echo "<option disabled selected value>Выберите тему...</option>";
            foreach ($themesList as $theme) 
                echo "<option value = '".$theme->theme_id."'>".$theme->name."</option>";
        }
        else
           echo "<option disabled selected value>Не найдено тем</option>";
    }
}

?>
