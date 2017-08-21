<?php 

namespace app\models;

use Yii;
use yii\base\Model;


class Profile extends Model
{
	public $user_id;
	public $privateUserInfo;
	public $faculcyInfo;
	public $cathedraInfo;
	public $countTest;
	public $marks;
	public $average;
    public $subjectAverage;
    public $mentorCathedraInfo;
    public $id;
    public $countStat;
    public $countQuestions;
    public $countThemes;
    public $efficiency;

	function __construct($user_id, $is_mentor = 0, $subj_id = null)
	{
        $this->user_id = $user_id;
        $this->privateUserInfo = self::getPrivateInfo();

        if($is_mentor == 1)
        {
            $this->mentorCathedraInfo = Mentor_cathedras::getName(Yii::$app->user->identity->mentor_cath);
            $this->id = $this->privateUserInfo->user_id;
            $this->countQuestions = self::getCountQuestions($this->user_id);
            $this->countStat = self::getCountStatistics($this->user_id);
            $this->countThemes = self::getCountThemes($this->user_id);
            $this->efficiency = self::getEfficiency();
        }
        else
        {
		    $this->countTest = self::getCountTests();
		    $this->cathedraInfo = Cathedras::getCathedraByGroupNumber($this->privateUserInfo->group_number);
		    $this->faculcyInfo = Faculties::getFaculcyByCathedraId($this->cathedraInfo->cath_id);
		    $this->marks = self::getMakrsCount();
		    $this->average = Statistics::getTotalStatistics($user_id, 'mark');
        }
	}

	private function getPrivateInfo()
    {
        $privateUserInfo = User::findOne($this->user_id); 

        return $privateUserInfo;  
    }

    private function getCountTests()
    {
    	$countTest = Statistics::find()
            ->where([
                'user_id' => $this->user_id,
                'is_complete' => '1',
        	])
        	->count();

        return $countTest;
    }

    private function getMakrsCount()
    {
    	$sampleTests = Statistics::find()
    		->where([
    			'user_id' => $this->user_id,
    			'is_complete' => '1',
    		])
    		->all();
    	$sampleMarks = [
    		'non_pass_mark' => 0,
    		'pass_mark' => 0,
    		'dece_mark' => 0,
    		'exce_mark' => 0,

    	];
    	foreach ($sampleTests as $test) 
    	{
    		$themesMarks = Themes::find()
    			->select(['pass_mark', 'dece_mark', 'exce_mark'])
    			->where(['theme_id' => Test::dumpNumberVariant($test->number_variant, 'theme_id')])
    			->one();
    		
    		if($themesMarks->pass_mark > $test->mark)
    			$sampleMarks['non_pass_mark']++;
    		elseif($themesMarks->pass_mark <= $test->mark && $themesMarks->dece_mark > $test->mark)
    			$sampleMarks['pass_mark']++;
    		elseif($themesMarks->dece_mark <= $test->mark && $themesMarks->exce_mark > $test->mark)
    			$sampleMarks['dece_mark']++;
    		elseif($themesMarks->dece_mark == $test->mark)
    			$sampleMarks['exce_mark']++;
    	}
    	return $sampleMarks;
    }

    private function getAverage()
    {
    	$sampleMarks = Statistics::find()
    		->select('mark')
    		->where([
    			'user_id' => $this->user_id,
    			'is_complete' => '1',
    		])
    		->all();

    	foreach ($sampleMarks as $sampleMark) 
    		$summ += $sampleMark->mark;

    	if($summ !=0)
    		return $summ/count($sampleMarks)/10*5;
    	else
    		return 0;
    }

    public static function getSubjectAverage($user_id, $subj_id)
    {
        $themes = Statistics::find()
            ->select('theme_id')
            ->distinct()
            ->where([
                'subject_id' => $subj_id,
                'user_id' => $user_id,
                ])
            ->all();

        $types = Types::find()
            ->orderby('type_id DESC')
            ->limit(3)
            ->all();

       for($i = 0; $i < count($themes); $i++)
       {
            for($j = 0; $j < count($types); $j++)
            {
                $eva_type = Evaluation_works::find()
                    ->where([
                        'theme_id' => $themes[$i]['theme_id'],
                        'type_id' => $types[$j]['type_id'],
                        'subj_id' => $subj_id,
                        'mentor_id' => Yii::$app->user->getId(),
                    ])
                    ->one();

                
                $value = Evaluation_works::calculate($eva_type->eva_id, $subj_id ,$themes[$i]['theme_id'], $types[$j]['type_id'], $user_id);
                if($value != NULL)
                {
                    $themeValue += $value;
                    $number_of_works += 1;
                }
            }


       }

       $themeValue = $themeValue/$number_of_works;

        return $themeValue;
        
    }

    public static function getMentorProfile()
    {
        var_dump(Yii::$app->user->getId()); die();
    }

    private static function getViewedStatisticsValue($user_id)
    {
        $total = Statistics::find()
            ->where(['mentor_id' => $user_id])
            ->count();

        $viewed = Statistics::find()
            ->where([
                'mentor_id' => $user_id,
                'is_viewed' => 1,
            ])
            ->count();

        if($viewed != 0)
        {
            $value = $total/$viewed/10;
            return $value;
        }
        else
        {
            return 0;
        }
    }

    private static function getCountThemes($user_id)
    {
        $total = Themes::find()
           ->where(['mentor_id' => $user_id])
           ->count();

        return $total; 
    }

    private static function getCountQuestions($user_id)
    {
        $themes = Themes::find()
            ->where(['mentor_id' => $user_id])
            ->all();

        $countQuestions = 0;
        foreach($themes as $theme)
        {
            $value = Questions::find()
                ->where(['theme_id' => $theme->theme_id])
                ->count();

            $countQuestions = $countQuestions + $value;
        }

        return $countQuestions;
    }

    private function getEfficiency()
    {
        $statValue = self::getViewedStatisticsValue($this->user_id);
        $statThemes = $this->countThemes;
        $statAuth = Yii::$app->user->identity->hits;
        $statQuestions = $this->countQuestions;

        $totalTheme = Themes::find()
            ->count();

        $totalQuestions = Questions::find()
            ->count();        

        $efficiency = $statValue + $statThemes/$totalTheme + $statQuestions/$totalQuestions + $statAuth/1000;

        if($efficiency != NULL || $efficiency != 0)
            return round($efficiency, 3); 
        else 
            return 0;
    }

    private static function getCountStatistics($user_id)
    {
        $total = Statistics::find()
            ->where(['mentor_id' => $user_id])
            ->count();

        return $total; 
    }
}