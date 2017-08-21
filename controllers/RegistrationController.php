<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Cathedras;
use app\models\Faculties;
use app\models\Groups;
use app\models\Signup;

class RegistrationController extends \yii\web\Controller
{
    public function actionSignup()
    {

        $model = new Signup();

        /*Create ORM entities*/
        $Faculties = new Faculties();
        $facultiesList = Faculties::find()
            ->orderby('name')
            ->all();
        $facultiesItems = ArrayHelper::map($facultiesList, 'fac_id', 'name');

        $Cathedras = new Cathedras();  

        $Groups = new Groups();
        $groupsList = Groups::find()
            ->orderby('group_number')
            ->all();
        $groupsItems = ArrayHelper::map($groupsList, 'group_number', 'group_number');

        /*This block of code (registration) will work when Signup form will be sended by the Post method*/
        /**************************************Begin registration**************************************/
        if(Yii::$app->request->post('Signup'))
        {   
            $model->attributes = Yii::$app->request->post('Signup');        
            $exampleLogin = $model->generateLogin();
            $examplePassword = $model->generatePassword();

            if($model->validate() && $model->signup($exampleLogin, $examplePassword))
            {   
                return $this->render('success', [
                    'model' => $model,
                    'exampleLogin' => $exampleLogin,
                    'examplePassword' => $examplePassword,
                ]);
                
            }            
        }
        /**************************************End registration**************************************/
        /*Render signup form with entities*/
        return $this->render('signup', [
            'Faculties' => $Faculties,
            'facultiesItems' => $facultiesItems,
            'Cathedras' => $Cathedras,
            'Groups' => $Groups,
            'groupsItems' => $groupsItems,    
            'model' => $model,
        ]);
    }

    public function actionShowcath($id)
    {
        $cathedrasList = Cathedras::find()
            ->where(['fac_id'=>$id])
            ->all();

        if(!empty($cathedrasList))
        {
            echo "<option disabled selected value>Выберите направление...</option>";
            foreach ($cathedrasList as $cathedra) 
                echo "<option value = '".$cathedra->cath_id."'>".$cathedra->name."</option>";
        }
        else
           echo "<option disabled selected value>Выберите направление...</option>";
    }


    public function actionShowgroups($id)
    {
        $groupsList = Groups::find()
            ->where(['cath_id'=>$id])
            ->all();

        if(!empty($groupsList))
        {
            echo "<option disabled selected value>Выберите номер группы...</option>";
            foreach ($groupsList as $group) 
                echo "<option value = '".$group->group_number."'>".$group->group_number."</option>";
        }
        else
           echo "<option disabled selected value>Выберите номер группы...</option>";
    }

}
