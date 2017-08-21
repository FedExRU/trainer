<?php 

namespace app\models;

use Yii;
use yii\base\Model;

class Questions_Model extends Model
{
	public $questionText;
	public $answers;
	public $is_correct;
	public $input_type;
	public $type_id;
	public $theme_id;
	public $question_id;

	function __construct($theme_id)
	{
		return $this->theme_id = $theme_id;
	}

	public function rules()
	{
		return [
			[['questionText', 'is_correct', 'type_id'], 'required', 'message' => ''],
			['answers', 'string'],
			['input_type', 'string']
		];
	}

	public function save()
	{

		if($this->type_id == 1)
			self::saveDemo();
		elseif($this->type_id == 2)
			self::saveTests();
		elseif($this->type_id == 3)
			self::savePractice();

		return true;
	}

	private function saveDemo()
	{

		$questionDemo = new Questions();

		$questionDemo->theme_id = $this->theme_id;
		$questionDemo->type_id = $this->type_id;
		$questionDemo->text = $this->questionText;
		$questionDemo->save();

		$this->question_id = $questionDemo->question_id;
		return true;
	}

	private function saveTests()
	{
		$questionTests = new Questions();
		$questionTests->theme_id = $this->theme_id;
		$questionTests->type_id = $this->type_id;
		$questionTests->text = $this->questionText;
		$questionTests->save();

		for($i = 0; $i < count($this->answers); $i++ )
		{
			$answer = new Answers();
			$answer->question_id = $questionTests->question_id;
			$answer->text = $this->answers[$i];

			if($this->is_correct != $i)
				$answer->is_correct = 0;
			else
				$answer->is_correct = 1;

			$answer->input_type = $this->input_type;
			$answer->save();
		}

		$this->question_id = $questionTests->question_id;
		return true;

	}

	private function savePractice()
	{
		$questionPractice = new Questions();
		$questionPractice->theme_id = $this->theme_id;
		$questionPractice->type_id = $this->type_id;
		$questionPractice->text = $this->questionText;
		$questionPractice->save();

		$answer = new Answers();
		$answer->question_id = $questionPractice->question_id;
		$answer->text = $this->answers;
		$answer->input_type = 'text';
		$answer->is_correct = 1;
		$answer->save();

		$this->question_id = $questionPractice->question_id;
		return true;
	}
}

?>