<?php 

namespace app\models;

use Yii;
use yii\base\Model;


class EvaluationConfig extends Model
{
	public $eva_id;
	public $theme_id;
	public $type_id;
	public $subj_id;
	public $rating;

	function rules()
	{
		return [
			[['eva_id', 'theme_id', 'type_id', 'subj_id', 'rating'], 'required', 'message' => 'Обязательное поле для выбора не было отмечено!'],
			[['theme_id', 'type_id', 'subj_id'], 'validateEvaluation'],
		];
	}

	public static function getTextNames($query)
	{
		foreach ($query as $q)
		{
			$model[count($model)] = [
				'id' => $q->row_id,
				'subjName' => Subjects::getNameByThemeId($q->theme_id),
				'themeName' => Themes::getName($q->theme_id),
				'typeName' => Types::getName($q->type_id),
				'evaName' => Evaluation::getName($q->eva_id),
				'rating' => $q->rating
			];
		}

		return $model;
	}

	public function validateEvaluation($attribute,$params)
	{
		$eva = Evaluation_works::findOne([
			'theme_id' => $this->theme_id,
			'type_id' => $this->type_id,
			'subj_id' => $this->subj_id,
		]);

		if($eva)
		{
			$this->addError($attribute, 'Такой параметр оценивания уже существует!');
		}
	}

	public function save()
	{
		$eva = new Evaluation_works();
		$eva->eva_id = $this->eva_id;
		$eva->type_id = $this->type_id;
		$eva->subj_id = $this->subj_id;
		$eva->theme_id = $this->theme_id;
		$eva->mentor_id = Yii::$app->user->getId();
		$eva->rating = $this->rating;

		return $eva->save();
	}

	public function saveForSubject()
	{

		$eva = new Evaluation_subjects();
		$eva->subj_id = $this->subj_id;
		$eva->mentor_id = Yii::$app->user->getId();
		$eva->rating = $this->rating;
		
		return $eva->save();
	}
}

?>