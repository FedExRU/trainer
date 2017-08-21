<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Results extends ActiveRecord
{
	public static function getAnswers($number_variant)
	{
		$resultModel = Results::find()
			->where(['number_variant' => $number_variant])
			->all();

		$textQuestions = self::getTextQuestions($resultModel);

		$textAnswers = self::getTextAnswers($resultModel);

		return $answersModel = [
			'questions' => $textQuestions,
			'answers' => $textAnswers,
		];
	}

	private static function getTextQuestions($sampleQuestions)
	{	
		for($i = 0; $i < count($sampleQuestions); $i++)
		{
			$sampleTextQuestions[$i] = Questions::find()
				->select('text')
				->where(['question_id' => $sampleQuestions[$i]->test_question_id])
				->one();
		}
		return $sampleTextQuestions;
	}

	private static function getTextAnswers($sampleAnswers)
	{
		for($i = 0; $i < count($sampleAnswers); $i++)
		{
			if(Answers::getInputType($sampleAnswers[$i]->given_answer) != NULL)
			{	
				$sampleTextAnswers[$i] = Answers::find()
					->select(['text', 'is_correct'])
					->where(['answer_id' => $sampleAnswers[$i]->given_answer])
					->one();
				$sampleTextAnswers[$i]->background_color = self::getAnswerColor($sampleTextAnswers[$i]->is_correct);
			}
			else
			{
				$sampleTextAnswers[$i] = Answers::find()
					->select('text')
					->where(['question_id' => $sampleAnswers[$i]->test_question_id])
					->one();

				$sampleTextAnswers[$i]->background_color = self::getAnswerColor($sampleAnswers[$i]->given_answer, $sampleTextAnswers[$i]->text);
				$sampleTextAnswers[$i]->text = $sampleAnswers[$i]->given_answer;
			}	
		}

		return $sampleTextAnswers;
	}

	public static function getAnswerColor($sample_given_correct, $sample_answer_correct_text = null)
	{	
		if($sample_answer_correct_text == null)
		{
			if($sample_given_correct == '0')
				return $sample_background_color = '#DC143C';
			elseif($sample_given_correct == '1') 
				return $sample_background_color = '#9ACD32';
		}
		else
		{
			if($sample_given_correct != $sample_answer_correct_text)
				return $sample_background_color = '#DC143C';
			else
				return $sample_background_color = '#9ACD32';
		}

	}
}

?>