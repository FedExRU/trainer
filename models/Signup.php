<?php 

namespace app\models;

use Yii;
use yii\base\Model;


class Signup extends Model
{
	public $first_name;
	public $last_name;
	public $middle_name;
	public $group_number;

	function rules()
	{
		return [
			[['first_name', 'last_name', 'middle_name', 'group_number'], 'required', 'message' => 'Обязательное поле для ввода не было заполнено!'],
			[['first_name', 'last_name', 'middle_name'], 'validateUser'],
		];
	}

	function validateUser($attribute,$params)
	{
		$user = User::findOne([
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'middle_name' => $this->middle_name,
		]);

		if($user)
		{
			$this->addError($attribute, 'Пользователь с введенными ФИО уже существует!');
		}
	}

	function generateLogin()
	{
		$chars = 'ABCDEFGHIGKLMNOPQRSTUVWXYZ';
  		$numChars = strlen($chars);
  		$lastRecord = User::find()->orderBy(['user_id' => SORT_DESC])->one();

  		do
  		{
  			$string = '#';

  			for ($i = 0; $i < 3; $i++) 
  			{
  		  		$string .= substr($chars, rand(1, $numChars) - 1, 1);
  			}

  			$string .='.';

  			$string .=$lastRecord->user_id;
  			$sampleUser = User::find()->where(['login' => $string]);
  		}
  		while(!$sampleUser);

  		return $string;
	}

	function generatePassword()
	{
		$chars = 'absdefghigklmnopqrstuvwxyz';
		$numbs = '1234567890';
  		$numChars = strlen($chars);
  		$numNumbs = strlen($numbs);
  		$string = '@';

  		for ($i = 0; $i < 3; $i++) {
  		  $string .= substr($chars, rand(1, $numChars) - 1, 1);
  		}

  		$string .='.';

  		for ($i = 0; $i < 3; $i++) {
  		  $string .= substr($numbs, rand(1, $numNumbs) - 1, 1);
  		}

  		return $string;
	}

	function signup($login, $password)
	{
		$user = new User();

		$user->first_name = $this->first_name;
		$user->last_name = $this->last_name;
		$user->middle_name = $this->middle_name;
		$user->group_number = $this->group_number;
		$user->role_id = 3;
		$user->login = $login;
		$user->date = date("y-m-d");
		$user->password = Yii::$app->getSecurity()->generatePasswordHash($password);

		return $user->save();
	}

	public function getUser($login)
	{
		return User::findOne(['login' => $login]); // получаем пользователя по введенному логину
	}
}

?>