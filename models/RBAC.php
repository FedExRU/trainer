<?php 

namespace app\models;

use Yii;
use yii\base\Model;


class RBAC extends Model
{
	public function haveAccsess($current, $needed)
	{
		if($current != $needed)
		{
			if($needed == '2')
				$role = 'преподавателя';
			elseif($needed == '3')
				$role = 'студента';
			elseif($needed == '1')
				$role = 'администратора';

           \Yii::$app->view->renderFile('@app/views/exception.php', ['role'=> $role]);
		}
		else
		{
			return true;
		}
	}
}

?>