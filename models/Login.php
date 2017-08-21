<?php 

namespace app\models;

use Yii;
use yii\base\Model;


class Login extends Model
{
	public $login;
	public $password;

	public function rules()
	{
		return [
			[['login', 'password'], 'required', 'message' => 'Обязательные поля для ввода не были заполнены!'],
			[['password', 'login'], 'validateLogin'],
		];
	}

	public function validateLogin($attribute, $params)
	{
		if(!$this->hasErrors()) // если других ошибок в валидации нет
		{
			$user = $this->getUser(); // получаем пользоваетля для дальнейшего стравнения пароля

			if(!$user || !Yii::$app->getSecurity()->validatePassword($this->password, $user->password))
			{
				$this->addError($attribute, 'Пароль или пользователь не найдены');
			}
		}
		
	}

	public function getUser()
	{
		return User::findOne(['login' => $this->login]); // получаем пользователя по введенному логину
	}

	public static function checkUser($user_id)
	{
		$sampleUser = User::findOne($user_id);
		$sampleUser->hits+=1;
		$sampleUser->save();
	}
}

?>