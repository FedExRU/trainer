<?php 

namespace app\modules\mentor\controllers;

use Yii;
use yii\web\Controller;
use app\models\Statistics_view;
use app\models\Results;
use app\models\Commentaries;
use app\models\Log;
use app\models\StatisticsInfo;
use app\models\Subjects;
use app\models\Test;
use app\models\Statistics;
use app\models\Groups_subjects;
use yii\data\ActiveDataProvider;
use app\models\Types;
use yii\helpers\ArrayHelper;
use app\models\Themes;
use app\models\User;
use kartik\mpdf\Pdf;




class StatisticsController extends Controller
{
	public function actionDelete($number_variant)
	{
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);

		$sampleStatistics = Statistics_view::findOne(['number_variant' => $number_variant]);

		$sampleStatistics->delete();

		$subj_id = Test::dumpNumberVariant($number_variant, 'subj_id');

		return $this->redirect(['/mentor/statistics/showall', 'subj_id' => $subj_id]);
	}

	public function actionCheck($number_variant)
	{
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);

		$sampleStatistics = Statistics::findOne(['number_variant' => $number_variant]);

		$subj_id = Test::dumpNumberVariant($number_variant, 'subj_id');

		if($sampleStatistics->viewed() && Log::workWasViewed($sampleStatistics))
			return $this->redirect(['/mentor/statistics/showall', 
				'subj_id' => $subj_id,
			]);
	}

	public function actionShowall($subj_id, $user_id = null, $theme_id = null, $type_id = null)
	{
		\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);

        $students = Statistics_view::getStudents($subj_id);

        $types = Types::getArrayTypes();

        $themes= Statistics_view::getThemes($subj_id);

		$subject = Subjects::getName($subj_id);

		return $this->render('show_all', [
            'user_id' => $user_id,
            'theme_id' => $theme_id,
            'type_id' => $type_id,
            'subj_id' => $subj_id,
            'themes' => $themes,
            'types' => $types,
            'students' => $students,
			'subject' => $subject,
		]);		
	}

    public function actionShowframe($subj_id, $user_id, $theme_id, $type_id)
    {   
        
        if($user_id == 'null')
            $user_id = null;

        if($theme_id == 'null')
            $theme_id = null;

        if($type_id == 'null')
            $type_id = null;

        $model = Statistics_view::generateStatistics($subj_id, $user_id, $theme_id, $type_id);

        return $this->renderPartial('show_all_frame', [
            'model' => $model,
        ]);

    }

	public function actionShowone($number_variant, $user_id)
    {   
    	\app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);

        $model = StatisticsInfo::getAllInfo($number_variant, $user_id);

        $sampleStatistics = Statistics::findOne(['number_variant' => $number_variant]);

        $answers = Results::getAnswers($number_variant);

        $comment_model = new Commentaries();

        $subj_id = Test::dumpNumberVariant($number_variant, 'subj_id');

        $comments = Commentaries::find()
            ->where(['number_variant' => $number_variant])
            ->orderBy('date DESC')
            ->all();


        if($sampleStatistics->is_viewed==0)
        {
            $sampleStatistics->viewed();
            Log::workWasViewed($sampleStatistics);
        }

        return $this->render('show_one', [
            'model' => $model,
            'comments' => $comments,
            'answers' => $answers,
            'comment_model' => $comment_model,
            'subj_id' => $subj_id,
        ]);

    }

    public function actionGroup($subj_id)
    {	
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);

    	$groups = Groups_subjects::find()
    		->where(['subj_id' => $subj_id])
    		->orderBy('group_number')
    		->all();

    	$subject = Subjects::getName($subj_id);
    	
    	$groups = ArrayHelper::map($groups, 'group_number', 'group_number');

    	return $this->render('group', [
    		'subject' => $subject,
    		'subj_id' => $subj_id,
    		'groups' => $groups,
    	]);
    }

    public function actionShowstat($subj_id, $group_number)
    {
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 2);
        
    	$groupStat = StatisticsInfo::getGroupStatistics($group_number, $subj_id);
    	$statValues = StatisticsInfo::getValues($groupStat, $subj_id);

    	return $this->renderPartial('group_stat', [
    		'statValues' => $statValues,
    		'groupStat' => $groupStat,
    		'subj_id' => $subj_id,

    	]);
    }

    public function actionReport($subj_id, $group_number) 
    {
        // get your HTML raw content without any layouts or scripts
        $groupStat = StatisticsInfo::getGroupStatistics($group_number, $subj_id);
        $statValues = StatisticsInfo::getValues($groupStat, $subj_id);
        $subject = Subjects::getName($subj_id);
        $mentor = User::findOne(Yii::$app->user->getId());
        $content = $this->renderPartial('_reportView', [
            'statValues' => $statValues,
            'groupStat' => $groupStat,
            'subj_id' => $subj_id,
            'group_number' => $group_number,
            'mentor' => $mentor,
        ]);
    
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => 'css/report.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Отчет о деятельности группы'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Отчет о деятельности группы с портала trainer.uni-dubna.ru'], 
            ]
        ]);

    // return the pdf output as per the destination setting
        return $pdf->render(); 
    }
}

?>