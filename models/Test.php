<?php 

namespace app\models;

use Yii;
use yii\base\Model;

class Test extends Model
{	
	public $questionsCount;
	public $type_id;
	public $theme_id;
	public $number_variant;
	public $questions;
	public $answers;

	public function generateTest($type_id, $theme_id, $questionsCount)
	{
		$this->questionsCount = $questionsCount;
        $this->type_id = $type_id;
        $this->theme_id = $theme_id;
		$this->number_variant = self::generateNumberVariant();
		$this->questions = self::generateQuestions();

		if($this->questions == true)
			self::insertStatistics($this->number_variant);
	}

	public function generateDemos($type_id, $theme_id)
	{	
		$sampleQuestions = Questions::find()
            ->where([
                    'theme_id' => $theme_id,
                    'type_id' => $type_id,
            ])
            ->all();
         
        return $sampleQuestions;
	}

	private function generateQuestions()
	{

		if($this->type_id != 4)
		{
			$sampleQuestions = Questions::find()
        	    ->orderBy('RAND()')
        	    ->where([
        	            'theme_id' => $this->theme_id,
        	            'type_id' => $this->type_id,
        	    ])
        	    ->limit($this->questionsCount)
        	    ->all();
        }
        else
        {
        	$sampleTestQuestions = Questions::find()
        	    ->orderBy('RAND()')
        	    ->where("theme_id = '".$this->theme_id."' and type_id = '2'")
        	    ->limit($this->questionsCount / 2)
        	    ->all();

        	$samplePracticeQuestions = Questions::find()
        	    ->orderBy('RAND()')
        	    ->where("theme_id = '".$this->theme_id."' and type_id = '3'")
        	    ->limit($this->questionsCount / 2)
        	    ->all();

        	 $sampleQuestions = array_merge($sampleTestQuestions, $samplePracticeQuestions);
        }

        for($i = 0; $i < count($sampleQuestions); $i++)
        {
        	$test_questions = new Test_questions();
        	$test_questions->number_variant = $this->number_variant;
        	$test_questions->test_question_id = $sampleQuestions[$i]->question_id;

        	$test_questions->save();
        }

        if ($test_questions != NULL)
        	return true;
        else
        	return false;
	}

	private static function insertStatistics($number_variant)
	{

		$sampleStatistics = new Statistics();
		$sampleStatistics->user_id = Yii::$app->user->getId();
		$sampleStatistics->number_variant = $number_variant;
		$sampleStatistics->subject_id = self::dumpNumberVariant($number_variant, 'subj_id');
		$sampleStatistics->type_id = self::dumpNumberVariant($number_variant, 'type_id');
		$sampleStatistics->theme_id = self::dumpNumberVariant($number_variant, 'theme_id');
		$sampleStatistics->date_begin = date("Y-m-d H:i:s");
		$sampleStatistics->mentor_id = Themes::getMentorId(self::dumpNumberVariant($sampleStatistics->number_variant, 'theme_id'));
		$sampleStatistics->save();
	}

	public static function showQuestions($number_variant)
	{
		$questions_query = Test_questions::find()
    		->where([
    			'number_variant' => $number_variant,
    		])
    		->orderBy('test_question_id')
    		->all();


    	for($i = 0; $i < count($questions_query); $i++)
    	{
    		$questions[$i] = Questions::find()
    			->where(['question_id' => $questions_query[$i]->test_question_id])
    			->one();
    	}

    	return $questions;
	}

	public static function showAnswers($sampleQuestions)
	{

		for ($i=0; $i < count($sampleQuestions); $i++) 
        { 
            $answers[$i] = Answers::find()
                ->where([
                        'question_id' => $sampleQuestions[$i]->question_id,
                ])
                ->all();
        }
        return $answers;
	}

	public static function showInfo($number_variant = null, $type_id = null, $theme_id = null)
	{	
		if($number_variant != null)
		{
			$type_id = self::dumpNumberVariant($number_variant, 'type_id');
			$theme_id = self::dumpNumberVariant($number_variant, 'theme_id');
			$subj_id = self::dumpNumberVariant($number_variant, 'subj_id');

			$infoQuery['type'] = Types::find()
				->select('name')
				->where(['type_id' =>$type_id])
				->one();

			$infoQuery['theme'] = Themes::find()
				->select('name')
				->where(['theme_id' => $theme_id])
				->one();

			$infoQuery['subject'] = Subjects::find()
				->select('name')
				->where(['subj_id' => $subj_id])
				->one();

			$sampleInfo['type'] = $infoQuery['type']->name;
			$sampleInfo['type_id'] = $type_id;
			$sampleInfo['theme'] = $infoQuery['theme']->name;
			$sampleInfo['subject'] = $infoQuery['subject']->name;
			$sampleInfo['number_variant'] = $number_variant;
		}
		else
		{
			$infoQuery['type'] = Types::find()
				->select('name')
				->where(['type_id' =>$type_id])
				->one();
			$sampleInfo['type'] = $infoQuery['type']->name;

			$infoQuery['theme'] = Themes::find()
				->select(['name', 'theme_id'])
				->where(['theme_id' => $theme_id])
				->one();

			$sampleInfo['theme'] = $infoQuery['theme']->name;

			$infoQuery['subject'] = Subjects::find()
				->select('name')
				->where(['subj_id' => $infoQuery['theme']->theme_id])
				->one();
			$sampleInfo['subject'] = $infoQuery['subject']->name;
		}

		if($type_id == 4)
		{	
			$sampleInfo['test_date'] = self::generateTestTime($number_variant);
		}

		return $sampleInfo;
	}

	private static function generateTestTime($number_variant)
	{
		$date_begin = Statistics::findOne(['number_variant' => $number_variant]);
		$var_date_begin = $date_begin->date_begin;

		$beginDate = date_create($var_date_begin)->Format('H:i:s');
		$endDate = new \DateTime(); 
		$endDate->add(new \DateInterval('PT20M')); 

		$endDate = $endDate->format('H:i:s');
		$rasnica = strtotime($beginDate) - strtotime($endDate);
		$rasnica = date('i:s',$rasnica);
		//var_dump($rasnica); die();
		return $rasnica;
	}

	private function generateNumberVariant()
	{
		if($this->type_id == 1)
			$char = "D";
		else if ($this->type_id == 2)
			$char = "T";
		else if ($this->type_id == 3)
			$char = "P";
		else
			$char = "E";

		$lastRecord = Statistics::find()->orderBy(['stat_id' => SORT_DESC])->one();
		$numbs = '1234567890';
		$subj_id_query = Themes::find()
			->where([
				'theme_id' => $this->theme_id,
			])
			->all();
		$subj_id = $subj_id_query[0]['subj_id'];
		$date = date('j-m-y');
  		$numNumbs = strlen($numbs);

  		do
  		{
  			$string = $char;

  			if($lastRecord !=NULL)
  				$string .= $lastRecord->stat_id;
  			else
  				$string .= "00";

  			$string .= "-".$this->type_id."-".$subj_id."-".$this->theme_id."-".$date."-";

  			for ($i = 0; $i < 6; $i++) 
  			{
  		  		$string .= substr($numbs, rand(1, $numNumbs) - 1, 1);
  			}

  			$sampleVariant = Test_questions::find()->where(['number_variant' => $string]);
  		}
  		while(!$sampleVariant);

  		return $string;
	}

	public static function getType($number_variant)
	{
		$data = $number_variant;
		list($type_chars, $type_id, $subj_id, $theme_id, $day, $month, $year, $random_numbs) = explode("-", $data);

		$sampleType = Types::find()
			->where(['type_id' => $type_id])
			->one();

		return $sampleType->name;
	}

	public static function getSubject($number_variant)
	{
		$data = $number_variant;
		list($type_chars, $type_id, $subj_id, $theme_id, $day, $month, $year, $random_numbs) = explode("-", $data);

		$sampleSubject = Subjects::find()
			->where(['subj_id' => $subj_id])
			->one();

		return $sampleSubject->short_name;
	}

	public static function getTheme($number_variant)
	{
		$data = $number_variant;
		list($type_chars, $type_id, $subj_id, $theme_id, $day, $month, $year, $random_numbs) = explode("-", $data);

		$sampleTheme = Themes::find()
			->where(['theme_id' => $theme_id])
			->one();

		return $sampleTheme->name;
	}

	public static function dumpNumberVariant($number_variant, $needed_value)
	{
		$data = $number_variant;
		list($type_chars, $type_id, $subj_id, $theme_id, $day, $month, $year, $random_numbs) = explode("-", $data);

		$dumped_number_variant = [
			"type_chars" => $type_chars,
			"type_id" => $type_id,
			"subj_id" => $subj_id,
			"theme_id" => $theme_id,
			"day" => $day,
			"month" => $month,
			"year" => $year,
			"random_numbs" => $random_numbs,
		];

		return $dumped_number_variant[$needed_value];
	}

	public static function getUncomplitedTest($user_id)
	{
		$sample_number_variant = Statistics::find()
			->select('number_variant')
			->where([
				'user_id' => $user_id,
				'is_complete' => '0'
			])
			->one();

		return $sample_number_variant;
	}

	public static function isNotComplete($number_variant)
	{
		$uncomplitedTest = Statistics::find()
			->where([
				'number_variant' => $number_variant,
				'is_complete' => '1',
			])
			->one();

		if($uncomplitedTest == 0)
			return true;
		else
			return false;
	}
}



?>