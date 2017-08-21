<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Subjects extends ActiveRecord
{
	public static function getSubjInfo($sampleSubjId)
	{
		for ($i=0; $i < count($sampleSubjId); $i++) 
		{ 	
			$sampleSubjects[$i] = Subjects::find()->select(['name', 'subj_id'])->where(['subj_id' => $sampleSubjId[$i]->subj_id])->one();
		}

		if($sampleSubjects != NULL)
			sort ($sampleSubjects);
		
		return $sampleSubjects;
	} 

	public static function getName($sampleSubjId)
	{
		$sampleSubject = Subjects::findOne($sampleSubjId);

		return $sampleSubject->name;
	}

	public static function getShortName($sampleSubjId)
	{
		$sampleSubject = Subjects::findOne($sampleSubjId);

		return $sampleSubject->short_name;
	}

	public static function getNameByThemeId($sampleThemeId)
	{
		$sampleSubjectId = Themes::find()
			->select('subj_id')
			->where(['theme_id' => $sampleThemeId])
			->one();

		$sampleSubject = Subjects::findOne($sampleSubjectId->subj_id);

		
		return $sampleSubject->name;
	}

	public static function getIdByThemeId($theme_id)
	{
		$sampleTheme = Themes::findOne($theme_id);

		return $sampleTheme->subj_id;
	}

	public function getPath($subj_id)
	{
		$path = Subjects::findOne($subj_id);

		return $path->path;
	}

	public static function getArray()
	{
		$model = Mentors_subjects::find()
			->where(['mentor_id' => Yii::$app->user->getId()])
			->all();

		$subjects = array( );
		foreach ($model as $item) 
		{
			$subject = Subjects::findOne(['subj_id' => $item->subj_id]);
			array_push($subjects, $subject);
		}

		$subjects = ArrayHelper::map($subjects, 'subj_id', 'name');

		return $subjects;
	}

	public static function getArraySubjects($option = null)
	{
		if($option == NULL)
		{
			$subjQuery = Statistics::find()
				->where(['user_id'=> Yii::$app->user->getId()])
				->all();

			foreach($subjQuery as $sampleSubject)
			{
				
				$subjects[count($subjects)] = Subjects::findOne($sampleSubject->subject_id);
			}

			if($subjects != NULL)
			{
        		$subjects = ArrayHelper::map($subjects, 'subj_id', 'name');
        		natsort($subjects);
			}

			return $subjects;
		}

		if($option == 'evaluation')
		{
			$subjQuery = Evaluation_works::find()
				->where(['mentor_id'=> Yii::$app->user->getId()])
				->all();

			foreach($subjQuery as $sampleSubject)
			{	
				$subjects[count($subjects)] = Subjects::findOne($sampleSubject->subj_id);
			}

			if($subjects != NULL)
			{
        		$subjects = ArrayHelper::map($subjects, 'subj_id', 'name');
        		natsort($subjects);
			}

			return $subjects;
		}
	}

	public static function getNonSetedEVASubjects()
	{
		$mentorsSubjects = Mentors_subjects::find()
			->where(['mentor_id' => Yii::$app->user->getId()])
			->all();

		foreach ($mentorsSubjects as $mentorSubject) 
			$ids[count($ids)] = $mentorSubject->subj_id;

		$subjects = Subjects::find()
			->where([
				'subj_id' => $ids,
			])
			->all();

		$subjects = ArrayHelper::map($subjects, 'subj_id', 'name');

		return $subjects;
	}
}

?>