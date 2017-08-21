<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\EvaluationConfig;
use app\models\Evaluation_works;


class Evaluation_works extends ActiveRecord
{
	public static function getInfo($subj_id, $type_id, $theme_id)
	{
		if($subj_id == null)
		{
			$subject = Evaluation_works::find()
				->select('subj_id')
				->distinct()
				->all();

			foreach($subject as $s)
				$subj_id[count($subj_id)] .= $s->subj_id;
		}

		if($theme_id == null)
		{
			$themes = Themes::find()
			->where(['subj_id'=> $subj_id])
			->all();

			foreach($themes as $theme)
				$theme_id[count($theme_id)] .= $theme->theme_id;
		}

		if($type_id == null)
		{
			$types = Types::find()
			->all();

			foreach($types as $type)
				$type_id[count($type_id)] .= $type->type_id;
		}

		$query = Evaluation_works::find()
    		->where([
    			'mentor_id' => Yii::$app->user->getId(),
    			'subj_id' => $subj_id,
    			'theme_id' => $theme_id,
    			'type_id' => $type_id,
    		])
    		->orderby('row_id DESC')
    		->all();

    	$model = EvaluationConfig::getTextNames($query); 

    	return $model;
	}
	public static function calculate($eva_type, $subj_id ,$theme_id, $type_id, $user_id)
	{
		if($eva_type == 1 || $eva_type == null)
			return $value = self::getAverage($subj_id ,$theme_id, $type_id, $user_id);
		elseif($eva_type == 2)
			return $value =self::getLast($subj_id ,$theme_id, $type_id, $user_id);
		elseif($eva_type == 3)
			return $value = self::getMaximum($subj_id ,$theme_id, $type_id, $user_id);
	}

	private static function getAverage($subj_id ,$theme_id, $type_id, $user_id)
	{
		$stat = Statistics::find()
			->where([
				'user_id' => $user_id,
				'theme_id' => $theme_id,
				'type_id' => $type_id,
				'is_complete' => '1',
				'subject_id' => $subj_id,
			])
			->orderby('stat_id DESC')
			->all();
			//echo "<pre>";

				
		//var_dump($stat->number_variant);
		//break;
		//echo "<pre>";
		//var_dump($stat);
		if($stat != NULL) 
		{
			foreach($stat as $st)
			{
				//echo $st->mark;
				$value += $st->mark;
				//var_dump($st->number_variant); echo "<br>";
				//var_dump($st->mark); echo "<br>";
			}
		
			if(count($stat) !=0)
			{
				//$value[$i]['private'][$s] = round(($value[$i]['private'][$s]/count($stat))/10*5,2);
				return $value = round(($value/count($stat))/10*5,2);
			}

			else
				return $value = NULL;
			//var_dump($value[$i]['private'][$s]);
		}
			else
				return $value = NULL;
	}

	private static function getMaximum($subj_id ,$theme_id, $type_id, $user_id)
	{
		$stat = Statistics::find()
			->where([
				'user_id' => $user_id,
				'theme_id' => $theme_id,
				'type_id' => $type_id,
				'is_complete' => '1',
				'subject_id' => $subj_id,
			])
			->orderby('mark DESC')
			->one();

		if($stat != NULL)
			$value = round($stat['mark']/10*5,2);
		else $value = NULL;

		return $value;
	}

	private static function getLast($subj_id ,$theme_id, $type_id, $user_id)
	{
		$stat = Statistics::find()
			->where([
				'user_id' => $user_id,
				'theme_id' => $theme_id,
				'type_id' => $type_id,
				'is_complete' => '1',
				'subject_id' => $subj_id,
			])
			->orderby('stat_id DESC')
			->one();

		if($stat != NULL)
			$value = round($stat['mark']/10*5,2);
		else $value = NULL;

		return $value;
	}
}

?>