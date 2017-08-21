<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Evaluation_subjects extends ActiveRecord
{
	public static function getMySubjects()
	{
		$model = Evaluation_subjects::find()
			->where(['mentor_id' => Yii::$app->user->getId()])
			->all();

		$subjects = array ();

		if(!empty($model))
		{
			foreach($model as $item)
			{
				$subject = Subjects::findOne($item->subj_id);
				$properties = [
					'name' => $subject->name,
					'rating' => $item->rating,
					'id' => $item->row_id,
				];
				array_push($subjects, $properties);
			}
		}

		return $subjects;
	}

	public static function getNonSettedSubjectsArray()
	{
		$model = Evaluation_subjects::find()
			->where(['mentor_id' => Yii::$app->user->getId()])
			->all();

		$ids = array();
		$subject_array = array();

		if(!empty($model))
		{
			foreach($model as $item)
				array_push($ids, $item->subj_id);
		}

		if(!empty($ids))
		{
			$subjects = Mentors_subjects::find()
				->where(['not in', 'subj_id', $ids])
				->andWhere(['mentor_id' => Yii::$app->user->getId()])
				->all();

			if(!empty($subjects))
			{
				foreach($subjects as $subject)
				{
					$unit = Subjects::findOne($subject->subj_id);
					array_push($subject_array, $unit);
				}
			}
		}
		else
		{
			$subjects = Mentors_subjects::find()
				->where(['mentor_id' => Yii::$app->user->getId()])
				->all();

			if(!empty($subjects))
			{
				foreach($subjects as $subject)
				{
					$unit = Subjects::findOne($subject->subj_id);
					array_push($subject_array, $unit);
				}
			}
		}

		if(!empty($subject_array))
			$subject_array = ArrayHelper::map($subject_array, 'subj_id', 'name');

		return $subject_array;
	}
}

?>