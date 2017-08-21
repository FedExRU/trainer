<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Statistics_view;

class Statistics extends ActiveRecord
{
	/******************************************/
	public $type;
	public $subject;
	public $theme;
	public $subj_id;
	public $textmark;
	public $maxMark;
	public $background_color;
	public $mentor;
	public $has_comments;
	public $studentname;

	public function viewed()
	{
		$this->is_viewed = 1;
		$this->save();

		$sampleStatistics = Statistics_view::findOne(['number_variant' => $this->number_variant]);

		//var_dump($this->number_variant); die();

		$sampleStatistics->is_viewed = '1';
		$sampleStatistics->save();

		$statistics = Statistics::findOne(['number_variant' => $this->number_variant]);

		//var_dump($this->number_variant); die();

		$statistics->is_viewed = '1';
		$statistics->save();

		return true;
	}

	public static function generateTextMark($number_mark, $number_variant)
	{	
		$theme_id = Test::dumpNumberVariant($number_variant, 'theme_id');
		$markValue = Themes::getMarkValues($theme_id);

		if($number_mark < $markValue->pass_mark)
			return $textMark = 'Неудовлетворительно';
		elseif ($number_mark >= $markValue->pass_mark && $number_mark < $markValue->dece_mark)
			return $textMark = 'Удовлетворительно';
		elseif ($number_mark >= $markValue->dece_mark && $number_mark < $markValue->exce_mark)
			return $textMark = 'Хорошо';
		elseif($number_mark == $markValue->exce_mark)
			return $textMark = 'Отлично';
	}

	public static function generateMarkColor($number_mark, $number_variant)
	{
		$theme_id = Test::dumpNumberVariant($number_variant, 'theme_id');
		$markValue = Themes::getMarkValues($theme_id);

		if($number_mark < $markValue->pass_mark)
			return $sample_background_color = '#DC143C';
		elseif ($number_mark >= $markValue->pass_mark && $number_mark < $markValue->dece_mark)
			return $sample_background_color = '#FF8C00';
		elseif ($number_mark >= $markValue->dece_mark && $number_mark < $markValue->exce_mark)
			return $sample_background_color = '#FFD700';
		elseif($number_mark == $markValue->exce_mark) 
			return $sample_background_color = '#9ACD32';
	}

	public static function generateMaxMark ($number_variant)
	{
		$sampleMaxMark = Test_questions::find()
			->where(['number_variant' => $number_variant])
			->count();

		return $sampleMaxMark;
	}

	public static function generateMentorInfo($number_variant)
	{
		$theme_id = Test::dumpNumberVariant($number_variant, 'theme_id');
		$mentor = Themes::getMentor($theme_id);

		return $mentor;
	}

	public static function getCountStatistics($subjects, $user_id)
	{
		$sampleStatistics = Statistics::find()
			->select(['number_variant'])
			->all();

		for($i = 0; $i < count($subjects); $i++)
		{
			$sampleCountStatistics['total'][$i] = 0;
			$sampleCountStatistics['viewed'][$i] = 0;
			for($j = 0; $j < count($sampleStatistics); $j++)
			{	
				$sampleStat = Statistics::findOne(['number_variant' => $sampleStatistics[$j]->number_variant]);
				$sampleStatId = Test::dumpNumberVariant($sampleStat->number_variant, 'subj_id');
				
				if($sampleStatId == $subjects[$i]->subj_id)
				{
					$sampleCountStatistics['total'][$i] = $sampleCountStatistics['total'][$i]+1;
					if($sampleStat->is_viewed=='1')
						$sampleCountStatistics['viewed'][$i] = $sampleCountStatistics['viewed'][$i]+1;
				}
			}
		}

		return $sampleCountStatistics;
	}

	public function copy()
	{
		$copy = new Statistics_view();
		$copy->subj_id = Test::dumpNumberVariant($this->number_variant, 'subj_id');
		$copy->number_variant = $this->number_variant;
		$copy->theme_id = Test::dumpNumberVariant($this->number_variant, 'theme_id');
		$copy->type_id = Test::dumpNumberVariant($this->number_variant, 'type_id');
		$copy->mark = $this->mark;
		$copy->user_id = $this->user_id;
		$copy->date = $this->date_end;
		$copy->mentor_id = Themes::getMentorId(Test::dumpNumberVariant($this->number_variant, 'theme_id'));
		$copy->save();
	}

	public static function getTotalStatistics($user_id, $option)
	{
		$totalTotal = 0;
		$user = $user_id;
		
		$statistics = Statistics::find()
			->select('subject_id')
			->distinct()
			->where(['user_id' => $user])
			->all();

		sort($statistics);

		$types = Types::find()
			->orderby('type_id DESC')
			->limit(3)
			->all();

		$types = array_reverse($types);
		//echo "<pre>";
		$i = 0;
		$count_subj = 0;
		foreach($statistics as $stat)
		{	
			
			$totalSubjMark = 0;
			$subj_id = $stat->attributes['subject_id'];
			
			$themes = Statistics::find()
				->select('theme_id')
				->distinct()
				->where([
					'subject_id' => $subj_id,
					'user_id' => $user,
				])
				->all();

			$count_works = 0;
			if($themes != NULL)
			{
				//echo "<h2>Проверяется предмет ".$subj_id."</h2>"; echo "<br>";
				$array['subjects'][$i]['name'] = Subjects::getName($subj_id);
				$array['subjects'][$i]['short_name'] = Subjects::getShortname($subj_id);

				$j = 0;
				foreach($themes as $theme)
				{
					$totalThemeMark = 0;
					//echo "<h3>Проверяется тема ".$theme->theme_id." предмета ".$subj_id."</h3>"; echo "<br>";
					//var_dump($theme->theme_id); die();
					//$themeArray(count($themeArray)) = Themes::getName($theme->theme_id);
					//$subjArray[count($subjArray)]
					$array['themes'][Subjects::getName($subj_id)][$j]['name'] =  Themes::getName($theme->theme_id);
					$k = 0;
					$count_type = 0;
					foreach($types as $type)
					{
						$eva_type = Evaluation_works::find()
							->where([
								'theme_id' => $theme->theme_id,
								'type_id' => $type->type_id,
								'subj_id' => $subj_id,
							])
							->one();

						if($eva_type->eva_id == 1 || $eva_type->eva_id == null)
						{
							//var_dump($type->theme_id); die();
							$theme_type_stat = Statistics::find()
								->where([
									'user_id' => $user,
									'theme_id' => $theme->theme_id,
									'type_id' => $type->type_id,
									'subject_id' => $subj_id,
								])
								->all();

							if($theme_type_stat != NULL)
							{
								$count_type++;
								$value = 0;
								//echo "<h4>Проверяется тип ".$type->type_id." темы ".$theme->theme_id." предмета ".$subj_id."</h4>"; echo "<br>";
								$array['types'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][$k]['name'] = Types::getName($type->type_id);
								$array['types'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][$k]['evaluation'] = 'Средний балл';

								$z = 0;
								foreach($theme_type_stat as $s)
								{
									//echo "Номер варианта ".$s->number_variant." Баллы ".$s->mark; echo "<br>";
									$array['result'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][Types::getName($type->type_id)][$z]['number_variant'] = $s->number_variant;
									$array['result'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][Types::getName($type->type_id)][$z]['mark'] = $s->mark;
									$value += $s->mark;
									$number_of_works++;
									$z++;
								}
								if(count($theme_type_stat) != 0)
									$srBall = $value/count($theme_type_stat)/10*5;
								//echo "<h3> Средний балл ".round($srBall, 2)."<h4>";
								$array['types'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][$k]['mark'] = round($srBall, 2);
								$totalThemeMark +=$srBall;
								$totalSubjMark +=$srBall;
								$count_works++;
							}
						}
						elseif($eva_type->eva_id == 2)
						{

							$stat = Statistics::find()
								->where([
									'user_id' => $user,
									'theme_id' => $theme->theme_id,
									'type_id' => $type->type_id,
									'subject_id' => $subj_id,
								])
								->orderby('stat_id DESC')
								->one();

							if($stat != NULL)
							{
								$value = 0;
								$count_type++;
								$array['types'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][$k]['name'] = Types::getName($stat['type_id']);
								$array['types'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][$k]['evaluation'] = 'Последняя оценка';
								$array['result'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][Types::getName($type->type_id)][$z]['number_variant'] = $stat['number_variant'];
								$array['result'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][Types::getName($type->type_id)][$z]['mark'] = $stat['mark'];
								$srBall = round($stat['mark']/10*5,2);
								$number_of_works++;
								$z++;
							}
							$array['types'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][$k]['mark'] = round($srBall, 2);
							$totalThemeMark +=$srBall;
							$totalSubjMark +=$srBall;
							$count_works++;

						}
						elseif($eva_type->eva_id == 3)
						{

							$stat = Statistics::find()
								->where([
									'user_id' => $user,
									'theme_id' => $theme->theme_id,
									'type_id' => $type->type_id,
									'subject_id' => $subj_id,
								])
								->orderby('mark DESC')
								->one();

							if($stat != NULL)
							{
								$value = 0;
								$count_type++;
								$array['types'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][$k]['name'] = Types::getName($stat['type_id']);
								$array['types'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][$k]['evaluation'] = 'Высшая оценка';
								$array['result'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][Types::getName($type->type_id)][$z]['number_variant'] = $stat['number_variant'];
								$array['result'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][Types::getName($type->type_id)][$z]['mark'] = $stat['mark'];
								$srBall = round($stat['mark']/10*5,2);
								$number_of_works++;
								$z++;
							}
							$array['types'][Subjects::getName($subj_id)][Themes::getName($theme->theme_id)][$k]['mark'] = round($srBall, 2);
							$totalThemeMark +=$srBall;
							$totalSubjMark +=$srBall;
							$count_works++;

						}

							$k++;
					}
					$totalThemeMark = $totalThemeMark/$count_type;

					$array['themes'][Subjects::getName($subj_id)][$j]['mark'] =  round($totalThemeMark,2);
					//echo "<br>"; echo "<h2>Средний балл по теме ".$totalThemeMark."</h2>"; echo "<br>";
					$j++;
				}
			}
			//die();
			if($themes != NULL)
				$totalSubjMark = $totalSubjMark/$count_works;

			$totalTotal += $totalSubjMark;
			//echo "<h1>Средний балл по предмету ".$totalSubjMark."</h1>";
			//echo '_____________________________________'; echo "<br>";
			$array['subjects'][$i]['mark'] = round($totalSubjMark, 2);
			$i++;
			$count_subj++;
		}

		if($count_subj !=NULL)
			$totalTotal = $totalTotal;
		else
			$totalTotal = 0;

		//echo "<br>"; echo "<h1>СРЕДНИЙ БАЛЛ ПО РАБОТЕ В СИСТЕМЕ ".$totalTotal."</h1>"; echo "<br>";
		$array['total'] = round($totalTotal, 2);
		//echo "<pre>";
		//var_dump($array['types']);
		//die();

		if($option == 'full')
			return $array;

		if($option == 'mark')
			return $totalTotal;
	}

}

?>