<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Statistics_view extends ActiveRecord
{
	public $textmark;
	public $studentname;
	public $theme;
	public $background_color;

	public static function generateStatistics($subj_id, $user_id = null, $theme_id = null, $type_id)
	{

		if($user_id == null)
		{
			$students = Statistics_view::find()
				->select('user_id')
				->distinct()
				->all();

			foreach($students as $s)
				$user_id[count($user_id)] .= $s->user_id;
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



		$sampleStatistics = Statistics_view::find()
			->where([
				'subj_id' => $subj_id,
				'user_id' => $user_id,
				'theme_id' => $theme_id,
				'type_id' => $type_id,
				'mentor_id' => Yii::$app->user->getId(),
			])
			->all();




		for($i = 0; $i < count($sampleStatistics); $i++)
		{
			$sampleStatistics[$i]->textmark = Statistics::generateTextMark($sampleStatistics[$i]->mark, $sampleStatistics[$i]->number_variant);
			$sampleStatistics[$i]->theme = Test::getTheme($sampleStatistics[$i]->number_variant);
			$sampleStatistics[$i]->studentname = User::getStudentName($sampleStatistics[$i]->user_id);
		}

		if($sampleStatistics != NULL)
			rsort($sampleStatistics);

		return $sampleStatistics;
	}

	public static function getStudents($subj_id)
	{
		$students = Statistics_view::find()
            ->select('user_id')
            ->distinct()
            ->where(['subj_id' => $subj_id])
            ->all();

        for($i = 0; $i<count($students); $i++) 
        {
           $st = User::findOne($students[$i]->user_id);
           //var_dump($st); die();
           $student[$st->first_name]['user_id'] = $st->user_id;
           $student[$st->first_name]['first_name'] = User::getStudentName($st->user_id);
           $student[$st->first_name]['group_number']= "гр.".$st->group_number;
        }

        if($student !=NULL)
        {
        	ksort($student, SORT_REGULAR);
        	$student = ArrayHelper::map($student, 'user_id', 'first_name', 'group_number');
        }
       
        
        return $student;
	}

	public static function getThemes($subj_id)
	{
		$themes = Statistics_view::find()
            ->select('theme_id')
            ->distinct()
            ->where([
            	'subj_id' => $subj_id,
            	'mentor_id' => Yii::$app->user->getId(),
            ])
            ->all();

        foreach ($themes as $t) 
        {
           $theme[count($theme)] = Themes::findOne($t->theme_id);
        }

        if($theme != NULL)
        	$theme = ArrayHelper::map($theme, 'theme_id', 'name');

        return $theme;
	}

}

?>