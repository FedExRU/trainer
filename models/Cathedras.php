<?php 

namespace app\models;

use yii\db\ActiveRecord;

class Cathedras extends ActiveRecord
{
	public static function getCathedraByGroupNumber($group_number)
	{
		$sampleCathedraInfo_id = Groups::findOne($group_number);
		$sampleCathedraInfo = Cathedras::findOne($sampleCathedraInfo_id->cath_id);
		
		return $sampleCathedraInfo;
	}
}

?>