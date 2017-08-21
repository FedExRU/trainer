<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Themes extends ActiveRecord
{
	public static function getMarkValues($theme_id)
	{
		$sampleMarkValue = Themes::find()
			->select(['pass_mark', 'dece_mark', 'exce_mark'])
			->where(['theme_id' => $theme_id])
			->one();
			
		return $sampleMarkValue;
	} 

	public static function getMentor($theme_id)
	{
		$mentor_id = Themes::find()
			->where(['theme_id' => $theme_id])
			->one();

		$mentorInfo = User::find()
			->where(['user_id' => $mentor_id->mentor_id])
			->one();

	
		$mentor = $mentorInfo->first_name." ".substr($mentorInfo->last_name, 0, 2).". ".substr($mentorInfo->middle_name, 0, 2).".";
		return $mentor;
	}

	public static function getMentorId($theme_id)
	{
		$mentor_id = Themes::find()
			->where(['theme_id' => $theme_id])
			->one();

		$mentorInfo = User::find()
			->where(['user_id' => $mentor_id->mentor_id])
			->one();
	
		$mentor = $mentorInfo->user_id;
		return $mentor;
	}

	public static function getCountThemes($sampleSubjects, $user_id)
	{
		for($i = 0; $i < count($sampleSubjects); $i++)
		{
			$sampleCount['total'][$i] = Themes::find()
				->where(['subj_id' => $sampleSubjects[$i]->subj_id])
				->count();

			$sampleCount['private'][$i] = Themes::find()
				->where([
					'subj_id' => $sampleSubjects[$i]->subj_id,
					'mentor_id' => $user_id,
				])
				->count();
		}
		return $sampleCount;
	}

	public static function generateThemesInfo($sampleThemes)
	{
		for($i = 0; $i < count($sampleThemes); $i++)
		{
			$sampleInfo[$i]['countQuestions'] = Questions::find()
				->where(['theme_id' => $sampleThemes[$i]->theme_id])
				->count();

			$sampleInfo[$i]['countDemos'] = Questions::find()
				->where([
					'theme_id' => $sampleThemes[$i]->theme_id,
					'type_id' => 1,
				])
				->count();

			$sampleInfo[$i]['countTest'] = Questions::find()
				->where([
					'theme_id' => $sampleThemes[$i]->theme_id,
					'type_id' => 2,
				])
				->count();

			$sampleInfo[$i]['countPractice'] = Questions::find()
				->where([
					'theme_id' => $sampleThemes[$i]->theme_id,
					'type_id' => 3,
				])
				->count();
		}
		return $sampleInfo;
	}

	public static function getName($theme_id)
	{
		$name = Themes::findOne($theme_id);

		return $name->name;

	}

	public function createFolder($name)
	{
		$subjPath = Subjects::find()
			->select('path')
			->where(['subj_id' => $this->subj_id])
			->one();

		$sampleName = self::translit($name);

		mkdir('./img/demos/'.$subjPath->path.'/'.$sampleName);
		mkdir('./img/practice/'.$subjPath->path.'/'.$sampleName);
		mkdir('./img/testing/'.$subjPath->path.'/'.$sampleName);

		return $this->path = $sampleName;
	}

	public function deleteFolder()
	{
		$subjPath = Subjects::find()
			->select('path')
			->where(['subj_id' => $this->subj_id])
			->one();

		$themePath = Themes::find()
			->select('path')
			->where(['theme_id' => $this->theme_id])
			->one();

		$dir[0] = './img/testing/'.$subjPath->path.'/'.$themePath->path;

		$dir[1] = './img/demos/'.$subjPath->path.'/'.$themePath->path;

		$dir[2] = './img/practice/'.$subjPath->path.'/'.$themePath->path;

		Folder::terminate($dir);

		return true;
	}

	private static function translit($string)
	{	
		$string = mb_strtolower($string, 'UTF-8');
		$rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    	$lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');

    	return str_replace($rus, $lat, $string);
	}

	public function getPath($theme_id)
	{
		$path = Themes::findOne($theme_id);

		return $path->path;
	}

	public function terminate()
	{
		$questions = Questions::find()
			->where(['theme_id' => $this->theme_id])
			->all();

		if($questions != NULL)
		{
			foreach($questions as $question)
			{
				$answers = Answers::find()
					->where(['question_id' => $question->question_id])
					->all();

				if($answers != NULL)
				{
					foreach($answers as $answer)
						$answer->delete();
				}

				$results = Results::find()
					->where(['test_question_id' => $question->question_id])
					->all();

				if($results != NULL)
				{
					foreach($results as $result)
						$result->delete();
				}

				$testQuestion = Test_questions::find()
					->where(['test_question_id' => $question->question_id])
					->all();

				if($testQuestion != NULL)
				{
					foreach($testQuestion as $tq)
						$tq->delete();
				}

				$question->delete();
			}
		}

		$statistics = Statistics::find()
			->where(['theme_id' => $this->theme_id])
			->all();

		if($statistics != NULL)
		{
			foreach($statistics as $st)
			{
				$comments = Commentaries::find()
					->where(['number_variant' => $st->number_variant])
					->all();

				if($comments != NULL)
				{
					foreach ($comment as $k) 
						$k->delete();
				}

				$st->delete();
			}
		}

		$statistics_view = Statistics_view::find()
			->where(['theme_id' => $this->theme_id])
			->all();

		if($statistics_view != NULL)
		{
			foreach ($statistics_view as $stw) 
				$stw->delete();
		}

		$evaluation_works = Evaluation_works::find()
			->where(['theme_id' => $this->theme_id])
			->all();

		if($evaluation_works != NULL)
		{
			foreach ($evaluation_works as $ew) 
				$ew->delete();
		}


		$this->delete();
		return true;
	}

	public static function getArrayThemes($subjects)
	{
		if($subjects != NULL)
		{
			foreach($subjects as $key => $value)
			{
				$allThemes = Themes::find()->where(['subj_id' => $key])->all();
				//var_dump($allThemes); die();
				foreach($allThemes as $at)
				{
					//$themes[count($themes)] = Themes::findOne($at->theme_id);
					$theme = Themes::findOne($at->theme_id);
					$themes[$theme->theme_id]['theme_id'] = $theme->theme_id;
					$themes[$theme->theme_id]['name'] = $theme->name;
					$themes[$theme->theme_id]['subj'] = Subjects::getName($theme->subj_id);
				}
			}
		}

		if($themes != NULL)
		{
			ksort($themes, SORT_REGULAR);
        	$themes = ArrayHelper::map($themes, 'theme_id', 'name', 'subj');

		}
		
		return $themes;
	}

}

?>