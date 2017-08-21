<?php 

namespace app\models;

use yii\db\ActiveRecord;

class Answers extends ActiveRecord
{
	public $background_color;
	
	public static function getInputType($sample_answer_id)
	{
		$sample_answer_type = Answers::find()
			->where(['answer_id' => $sample_answer_id])
			->one();

		return $sample_answer_type->input_type;
	}

}

?>