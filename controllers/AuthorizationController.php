<?php

namespace app\controllers;

use Yii;
use app\models\Login;

class AuthorizationController extends \yii\web\Controller
{
    public function actionLogin()
    {
        $login_model = new Login();

        if(Yii::$app->request->post("Login"))
        {
            $login_model->attributes = Yii::$app->request->post("Login");

            if($login_model->validate())
            {
                Yii::$app->user->login($login_model->getUser());
                Login::checkUser(Yii::$app->user->getId());

                if(Yii::$app->user->identity->role_id == 3)
                    return $this->redirect(['/site']);
                elseif(Yii::$app->user->identity->role_id == 2)
                    return $this->redirect(['/mentor']);
                 elseif(Yii::$app->user->identity->role_id == 1)
                    return $this->redirect(['/admin']);
            }
        }

        return $this->render('login', [
            'login_model'=> $login_model,
        ]);
    }

    public function actionPrelogin($preLogin, $prePassword)
    {   
        $login_model = new Login();
        $login_model->password = $prePassword;
        $login_model->login = $preLogin;
        
        Yii::$app->user->login($login_model->getUser());
        Login::checkUser(Yii::$app->user->getId());
        return $this->redirect(['site/index']); 
    }

    public function actionLogout()
    {   
        Yii::$app->user->logout();
        return $this->redirect(['login']);   
    }

}
