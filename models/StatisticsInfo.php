<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;


class StatisticsInfo extends Model
{	
	public static function getBaseInfo($sampleUser_id, $subj_id, $type_id, $theme_id)
	{
		if($subj_id == null)
		{
			$subject = Statistics::find()
				->select('subject_id')
				->distinct()
				->all();

			foreach($subject as $s)
				$subj_id[count($subj_id)] .= $s->subject_id;
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

		$sampleModel = Statistics::find()
			->where([
				'user_id' => $sampleUser_id,
				'subject_id' => $subj_id,
				'theme_id' => $theme_id,
				'type_id' => $type_id,
				'is_complete' => '1',
			])
			->orderby('date_end DESC')
			->all();

		if($sampleModel != NULL)
		{
			foreach($sampleModel as $model)
			{
				$model->background_color = Statistics::generateMarkColor($model->mark, $model->number_variant);
				$model->textmark = Statistics::generateTextMark($model->mark, $model->number_variant);
				$model->subject = Test::getSubject($model->number_variant);
				$model->theme = Test::getTheme($model->number_variant);
				$model->has_comments = Log::hasComments($model->number_variant);
			}

			return $sampleModel;
		}
	}

	public static function getBaseMentorInfo($sampleUser_id)
	{
		$sampleModel = Statistics::find()
			->where([
				'mentor_id' => $sampleUser_id,
				'is_complete' => '1',
			])
			->orderby('date_end DESC')
			->all();

		if($sampleModel != NULL)
		{
			foreach($sampleModel as $model)
			{
				$model->background_color = Statistics::generateMarkColor($model->mark, $model->number_variant);
				$model->textmark = Statistics::generateTextMark($model->mark, $model->number_variant);
				$model->theme = Test::getTheme($model->number_variant);
				$model->subj_id = Test::dumpNumberVariant($model->number_variant, 'subj_id');;
				$model->studentname = User::getStudentName($model->user_id);
			}

			return $sampleModel;
		}
	}

	public static function getAllInfo($number_variant, $sampleUser_id)
	{
		$sampleModel = Statistics::find()
			->where([
				'user_id' => $sampleUser_id,
				'number_variant' => $number_variant,
			])
			->one();

		
		if($sampleModel != NULL)
		{
			$sampleModel->textmark = Statistics::generateTextMark($sampleModel->mark, $number_variant);
			$sampleModel->theme = Test::getTheme($sampleModel->number_variant);
			$sampleModel->subject = Test::getSubject($sampleModel->number_variant);
			$sampleModel->type = Test::getType($sampleModel->number_variant);
			$sampleModel->maxMark = Statistics::generateMaxMark($sampleModel->number_variant);
			$sampleModel->mentor = Statistics::generateMentorInfo($sampleModel->number_variant);
			$sampleModel->studentname = User::getStudentName($sampleUser_id);
			$sampleModel->subj_id = Test::dumpNumberVariant($number_variant, 'subj_id');
		}

		return $sampleModel;
	}


	public static function getGroupStatistics($group_number, $subj_id)
	{
		$students = User::find()
			->where(['group_number' => $group_number])
			->orderby('first_name')
			->all();

		$themes = Themes::find()
			->where(['subj_id' => $subj_id])
			->all();

		$types = Types::find()
			->orderby('type_id DESC')
			->limit(3)
			->all();
		
		$types = array_reverse($types);
		for($i = 0; $i < count($themes); $i++)
		{
			for($j = 0; $j < count($types); $j++)
			{
				for($k = 0; $k < count($students); $k++)
				{	
					$stat = Statistics::find()
						->where(['user_id' => $students[$k]->user_id])
						->orderby('stat_id DESC')
						->all();

					for($s = 0; $s < count($stat); $s++)
					{
						$theme_id = $themes[$i]->theme_id;
						$type_id = $types[$j]->type_id;

						$stat_theme_id = Test::dumpNumberVariant($stat[$s]->number_variant, 'theme_id');
						$stat_type_id = Test::dumpNumberVariant($stat[$s]->number_variant, 'type_id');
						
						if($theme_id == $stat_theme_id && $type_id == $stat_type_id)
						{
							$eva_type = Evaluation_works::find()
								->where([
									'theme_id' => $theme_id,
									'type_id' => $type_id,
									'subj_id' => $subj_id,
									'mentor_id' => Yii::$app->user->getId(),
								])
								->one();

							$name = Evaluation::getName($eva_type->eva_id);


							if($name != NULL)
								$eva_name = $name;
							else
								$eva_name = 'Средняя оценка';

							if($eva_type->rating != NULL)
								$rating = $eva_type->rating;
							else
								$rating = 2.5;

							$value[count($value)] = [
								'id'=> $theme_id.$type_id,
								'theme_id' => $theme_id,
								'type_id' => $type_id,
								'name' => Themes::getName($theme_id),
								'type' => $types[$j]->name,
								'eva_id' => $eva_type->eva_id,
								'eva_name' => $eva_name,
								'rating' => $rating,
							];				
						}
					}
				}
			}
		}

		for($i = 0; $i< count($themes); $i++)
		{
			for($j = 0; $j<count($types); $j++)
			{
				$id = $themes[$i]->theme_id.$types[$j]->type_id;
				for($k = 0; $k<count($value); $k++)
				{
					if(in_array($id, $value[$k]))
					{

						$rightValue[count($rightValue)] = $value[$k];
						break;
					}	
				}				
			}
		}
		$array['students'] = $students;
		$array['works'] = $rightValue;

		return $array;
	}

	public static function getValues($arrayInfo, $subj_id)
	{		
		$subject_evaluation = Evaluation_subjects::findOne([
			'mentor_id' => Yii::$app->user->getId(),
			'subj_id' => $subj_id,
		]);

		if($subject_evaluation->rating == NULL)
			$variable = 70;
		else
			$variable = $subject_evaluation->rating;

		$subject_evaluation_value = (5*$variable)/100;

		for($i = 0; $i < count($arrayInfo['students']); $i++)
		{
			$countConditions = 0;
			for($s = 0; $s < count($arrayInfo['works']); $s++)
			{
				$theme_id = $arrayInfo['works'][$s]['theme_id']; 
				$type_id = $arrayInfo['works'][$s]['type_id'];
				$eva_id = $arrayInfo['works'][$s]['eva_id'];
				$rating = $arrayInfo['works'][$s]['rating'];
				

				$value[$i]['private']['value'][$s] = Evaluation_works::calculate($eva_id, $subj_id ,$theme_id, $type_id, $arrayInfo['students'][$i]->user_id);

				if($value[$i]['private']['value'][$s] >= $rating)
				{
					$countConditions++;
					$value[$i]['private']['color'][$s] = '#badaa8';
				}

				if($value[$i]['private']['value'][$s] != NULL)
					$number_of_works[$i] += 1;				
			}

			for($z =0; $z < count($value[$i]['private']['value']); $z++)
			{
				$value[$i]['total']['value'] += $value[$i]['private']['value'][$z];
			}					
				

			if(count($number_of_works[$i])!=0)
			{
				$value[$i]['total']['value'] = round($value[$i]['total']['value']/$number_of_works[$i],2);

				if($countConditions == count($value[$i]['private']['value']) && $value[$i]['total']['value'] >= $subject_evaluation_value)
				{
					$value[$i]['total']['color'] = '#badaa8';
					$value[$i]['total']['status'] = ' (Зачтено)';
				}
			}
			else
				$value[$i]['total']['value'] = NULL;		
		}		
		return $value;
	}

}

?>
