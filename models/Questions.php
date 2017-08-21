<?php 

namespace app\models;

use yii\db\ActiveRecord;

class Questions extends ActiveRecord
{
	public static function getAnswers($sampleQuestions)
	{	
		for($i = 0; $i < count($sampleQuestions); $i++)
		{
			$sampleAnswers[$i] = Answers::find()
				->where(['question_id' => $sampleQuestions[$i]->question_id])
				->all();
		}

		return $sampleAnswers;
	}

	public static function getType($question_id)
	{
		$sampleQuestion = Questions::findOne($question_id);

		return $sampleQuestion->type_id;
	}

	public static function getTheme($question_id)
	{
		$sampleQuestion = Questions::findOne($question_id);

		return $sampleQuestion->theme_id;
	}

	public function terminate()
	{
		$answers = Answers::find()
			->where(['question_id' => $this->question_id])
			->all();

		if($answers != NULL)
		{
			foreach($answers as $answer)
				$answer->delete();
		}

		$results = Results::find()
			->where(['test_question_id' => $this->question_id])
			->all();

		if($results != NULL)
		{
			foreach($results as $result)
				$result->delete();
		}

		$testQuestion = Test_questions::find()
			->where(['test_question_id' => $this->question_id])
			->all();

		if($testQuestion != NULL)
		{
			foreach($testQuestion as $tq)
				$tq->delete();
		}
		
		$this->delete();
		return true;
	} 
}

?>