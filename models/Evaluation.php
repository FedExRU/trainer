<?php 

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Evaluation extends ActiveRecord
{
	public static function getName($eva_id)
	{
		$evaluation = Evaluation::findOne($eva_id);

		return $evaluation->name;
	}

	public static function getArrayEva()
	{
		$eva = Evaluation::find()
            ->orderBy('eva_id DESC')
            ->all();

        if($eva != NULL)
        {
        	$eva = array_reverse($eva);

        	$eva = ArrayHelper::map($eva, 'eva_id', 'name');
        }
        
        return $eva;
	}

}

?>