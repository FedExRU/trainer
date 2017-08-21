<?php 

namespace app\models;

use Yii;
use yii\base\Model;


class AnswersResult extends Model
{
	public $number_variant;
	public $testQuestionsId;	
	public $answers;

	function __construct($number_variant)
	{
		$this->number_variant = $number_variant;
	}

	public function rules()
	{
		return [
			[['answers', 'number_variant', 'testQuestionsId'], 'required', 'message' => ''],
		];
	}

	public function moderate()
	{		
		for ($i = 0; $i < count($this->answers); $i++) 
		{ 
			$sampleAnswer = Answers::find()
				->select('input_type')
				->where(['answer_id' => $this->answers[$i]])
				->one();

			if($sampleAnswer->input_type == 'radio')
				self::moderateRadio($this->answers[$i], $this->testQuestionsId[$i], $this->number_variant);
			else if($sampleAnswer->input_type == 'checkbox')
				{self::moderateCheckbox($this->answers[$i], $this->testQuestionsId[$i], $this->number_variant);}
			else
				self::moderateText($this->answers[$i], $this->testQuestionsId[$i], $this->number_variant);
		}

		return true;
	}

	public function saveTest()
	{	
		$mark = 0;
		$testQuestions = Test_questions::find()
			->where([
				'number_variant' => $this->number_variant,
			])
			->all();

		$testResult = Results::find()
			->where([
				'number_variant' => $this->number_variant,
			])
			->all();

		for ($i = 0; $i < count($testQuestions); $i++) 
		{ 
			$answerType = Answers::findOne(['question_id' => $testQuestions[$i]->test_question_id]);
				
			if($answerType->input_type == 'radio' || $answerType->input_type == 'text')
			{
				$answerMark = Results::find()
					->where([
						'test_question_id' => $testQuestions[$i]->test_question_id,
						'is_correct' => '1',
						'number_variant' =>$this->number_variant,
					])
					->count();

				if($answerMark == 1)
					$mark++;
			}
			else if($answerType->input_type == 'checkbox')
			{	
				$correctCountAnswers = Answers::find()
					->where([
						'question_id' => $testQuestions[$i]->test_question_id,
						'is_correct' => '1',
					])
					->count();

				$currentCountAnswers = Results::find()
					->where([
						'test_question_id' => $testQuestions[$i]->test_question_id,
						'number_variant' =>$this->number_variant,
					])
					->count();

				$currentCorrectCountAnswers = Results::find()
					->where([
						'test_question_id' => $testQuestions[$i]->test_question_id,
						'is_correct' => '1',
						'number_variant' =>$this->number_variant,
					])
					->count();

				if($correctCountAnswers == $currentCountAnswers && $correctCountAnswers == $currentCorrectCountAnswers)
					$mark++;
			}
		}

		$statistics = Statistics::findOne(['number_variant' => $this->number_variant, 'user_id' => Yii::$app->user->getId()]);
		$statistics->mark = $mark;
		$statistics->date_end = date("Y-m-d H:i:s");
		$statistics->is_complete = "1";
		$statistics->copy();
		$statistics->save();

		if(Log::workWasCompleted($statistics->number_variant, $statistics->mentor_id, $statistics->date_end))
			return true;
	}

	private static function moderateRadio($sampleAnswer, $sampleQuestion, $number_variant)
	{
		$sampleCorrect = Answers::findOne(['answer_id' => $sampleAnswer]);

		$result = new Results();
		$result->number_variant = $number_variant;
		$result->test_question_id = $sampleQuestion;
		$result->given_answer = $sampleAnswer;

		if($sampleCorrect->is_correct == 0)
			$result->is_correct = '0';
		else
			$result->is_correct = '1';

		return $result->save();
	}

	private static function moderateText($sampleAnswer, $sampleQuestion, $number_variant)
	{
		$sampleCorrect = Answers::findOne(['question_id' => $sampleQuestion]);

		$givenAnswer = trim($sampleAnswer);
		$givenAnswer = mb_strtolower($givenAnswer);

		$result = new Results();
		$result->number_variant = $number_variant;
		$result->test_question_id = $sampleQuestion;
		$result->given_answer = $sampleAnswer;

		if($givenAnswer != $sampleCorrect->text)
			$result->is_correct = '0';
		else
			$result->is_correct = '1';

		return $result->save();
	}

	private static function moderateCheckbox($sampleAnswerList, $sampleQuestion, $number_variant)
	{	
		for ($i = 0; $i < count($sampleAnswerList); $i++) 
		{ 
			$sampleCorrect = Answers::findOne(['answer_id' => $sampleAnswerList[$i]]);

			$result = new Results();
			$result->number_variant = $number_variant;
			$result->test_question_id = $sampleQuestion;
			$result->given_answer = $sampleAnswerList[$i];

			if($sampleCorrect->is_correct == 0)
				$result->is_correct = '0';
			else
				$result->is_correct = '1';

			$result->save();
		}

		return true;
	}
}
?>