<?php

namespace app\modules\mentor\controllers;

use Yii;
use yii\web\Controller;
use app\models\Questions;
use app\models\Themes;
use app\models\Subjects;
use app\models\Questions_Model;
use app\models\Types;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\models\UploadForm;


class QuestionsController extends Controller
{
	public function actionShow($theme_id)
	{
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
		$demos = Questions::find()
			->where([
				'theme_id' => $theme_id,
				'type_id' => 1,
			])
			->orderby('question_id  DESC')
			->all();

		$tests = Questions::find()
			->where([
				'theme_id' => $theme_id,
				'type_id' => 2,
			])
			->orderby('question_id DESC')
			->all();

		$answers['tests'] = Questions::getAnswers($tests);

		$practice = Questions::find()
			->where([
				'theme_id' => $theme_id,
				'type_id' => 3,
			])
			->orderby('question_id DESC')
			->all();

		$answers['practice'] = Questions::getAnswers($practice);

		$theme = Themes::getName($theme_id);
		$subject = Subjects::getNameByThemeId($theme_id);
		$subj_id = Subjects::getIdByThemeId($theme_id);


		return $this->render('show', [
			'theme_id' => $theme_id,
			'subject' => $subject,
			'theme'=> $theme,
			'demos' => $demos,
			'tests' => $tests,
			'practice' => $practice,
			'answers' => $answers,
			'subj_id' => $subj_id,
		]);
	}

	public function actionCreate($theme_id)
	{	
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
		$typesList = Types::find()
            ->limit(3)
            ->all();

        $typesItems = ArrayHelper::map($typesList, 'type_id', 'name');
        $uploadForm = new UploadForm();
		$model = new Questions_Model($theme_id);

		if (Yii::$app->request->isPost) 
		{	
			
			$model->attributes = Yii::$app->request->post('Questions_Model');

			if($model->save())
			{
				
           		$uploadForm->imageFile = UploadedFile::getInstance($uploadForm, 'imageFile');
           		if($uploadForm->imageFile != NULL)
           			$uploadForm->upload($model->question_id);
           		
        		return $this->redirect(['show', 'theme_id' => $theme_id]);
            }
        }
        
		return $this->render('create', [
			'model' => $model,
			'typesItems' => $typesItems,
			'uploadForm' => $uploadForm,
		]);
	}

	public function actionDelete($question_id, $theme_id)
	{
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
		$question = Questions::findOne($question_id);
		
		if($question->terminate())
			return $this->redirect(['show', 'theme_id' => $theme_id]);
	}

	public function actionEdit($question_id, $theme_id)
	{
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
		$model = Questions::findOne($question_id);

		$typesList = Types::find()
            ->limit(3)
            ->all();

        $typesItems = ArrayHelper::map($typesList, 'type_id', 'name');
        $uploadForm = new UploadForm();

		return $this->render('edit', [
			'model' => $model,
			'typesItems' => $typesItems,
			'uploadForm' => $uploadForm,
		]);
	}

	public function actionShowanswers($count, $input_type)
	{	
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
		return $this->renderPartial('show_answers', [
			'count' => $count, 
			'input_type' => $input_type
		]);
	}

	public function actionShowpacticefield()
	{
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
		return $this->renderPartial('show_practicefield');
	}
}

?>