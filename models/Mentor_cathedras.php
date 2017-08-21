<?php 

namespace app\models;

use yii\db\ActiveRecord;

class Mentor_cathedras extends ActiveRecord
{
	public function getShortName($cath_id)
	{
		$name = Mentor_cathedras::findOne($cath_id);

		return $name->short_name;
	}

	public function getName($cath_id)
	{
		$name = Mentor_cathedras::findOne($cath_id);

		return $name->name;
	}
}

?>