<?php 

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function getStudentName($user_id)
    {
        $studentInfo = User::find()
            ->where(['user_id' => $user_id])
            ->one();

    
        $student = $studentInfo->first_name." ".substr($studentInfo->last_name, 0, 2).". ".substr($studentInfo->middle_name, 0, 2).".";
        return $student;
    }
	public static function findIdentity($user_id)
	{
        return self::findOne($user_id);
	}

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {
    	
    }
}

?>