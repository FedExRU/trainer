<?php

namespace app\controllers;

use Yii;
use app\models\Test;
use app\models\AnswersResult;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionCreate()
    {	
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 3);
        if($_POST['type_id'] == '1')
        {    
            return $this->redirect(['show',
                'number_variant' => NULL,
                'type_id' => $_POST['type_id'],
                'theme_id' => $_POST['theme_id'],
            ]); 
        }

        $uncompletedTest = Test::getUncomplitedTest(Yii::$app->user->getId());

        if($uncompletedTest == NULL)
        {
            $test = new Test();

            $test->generateTest($_POST['type_id'], $_POST['theme_id'], 10);
            
            return $this->redirect(['show',
            	'number_variant' => $test->number_variant,
            ]); 
        }
        else
        {
            return $this->redirect(['show',
                'number_variant' => $uncompletedTest->number_variant,
            ]); 
        }
    }

    public function actionShow($number_variant = null, $type_id = null, $theme_id = null)
    {	
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 3);
        if($number_variant != NULL)
        {
            if(Test::isNotComplete($number_variant))
            {
    	       $questions = Test::showQuestions($number_variant);
    	       $answers = Test::showAnswers($questions);
    	       $info = Test::showInfo($number_variant);


               if($info['test_date'] > '40:00' || $info['test_date'] == '00:00')
               {
                    return $this->redirect(['/result/moderate',
                        'number_variant' => $number_variant,
                    ]); 
               }


    	       $model = new AnswersResult($questions);

    	       return $this->render('show', [
    	       	   'questions' => $questions,
    	       	   'answers' => $answers,
    	       	   'model' => $model,
    	       	   'info' => $info,
    	       ]);
            }
            else
            {
                return $this->redirect(['error',
                    'number_variant' => $number_variant,
                ]); 
            }
        }
        else
        {   
            $demo = new Test();
            $demo = $demo->generateDemos($type_id, $theme_id);
            $info = Test::showInfo(null, $type_id, $theme_id);

            return $this->render('show', [
                'questions' => $demo,
                'info' => $info,
            ]);
        }
    }

    public function actionError($number_variant)
    {     
        \app\models\RBAC::haveAccsess(Yii::$app->user->identity->role_id, 3);
        return $this->render('error',[
            'number_variant' => $number_variant,
        ]);
    }
}
