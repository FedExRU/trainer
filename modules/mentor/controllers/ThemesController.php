<?php 

namespace app\modules\mentor\controllers;

use Yii;
use yii\web\Controller;
use app\models\Mentors_subjects;
use app\models\Subjects;
use app\models\Themes;
use app\models\Theme_Model;


class ThemesController extends Controller
{
	public function actionShow($subj_id)
	{
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
		$themes = Themes::find()
			->where([
				'subj_id' => $subj_id, 
				'mentor_id' => Yii::$app->user->getId(),
			])
			->all();

		$themesInfo = Themes::generateThemesInfo($themes);

		$subject = Subjects::getName($subj_id);

		return $this->render('show', [
			'themes' => $themes,
			'subject' => $subjects,
			'themesInfo' => $themesInfo,
			'subj_id' => $subj_id
		]);
	}

	public function actionCreate($subj_id)
	{
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
		$model = new Theme_Model();

		if(Yii::$app->request->post('Theme_Model'))
        {   
            $model->attributes = Yii::$app->request->post('Theme_Model'); 
            if($model->validate() && $model->save($subj_id))
            {
            	return $this->redirect(['/mentor/themes/show', 'subj_id' => $subj_id]);
        	}
        }
		return $this->render('create', [
			'model' => $model,
		]);
	}

	public function actionEdit($theme_id, $subj_id)
	{
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
		$model = Themes::findOne($theme_id);
		$model->deleteFolder();

		if(Yii::$app->request->post('Themes'))
        {

        	$theme_model = new Theme_Model($theme_id);
        	$theme_model->attributes = Yii::$app->request->post('Themes');

        	if($theme_model->validate() && $theme_model->edit())
            {	
            	return $this->redirect(['/mentor/themes/show', 'subj_id' => $subj_id]);
        	}
        }

		return $this->render('edit', [
			'model' => $model,
		]);
	}

	public function actionDelete($theme_id, $subj_id)
	{
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
		$model = Themes::findOne($theme_id);
		$model->deleteFolder();
		$model->terminate();

		return $this->redirect(['/mentor/themes/show', 'subj_id' => $subj_id]);
	}
}

?>