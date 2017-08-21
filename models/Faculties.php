<?php 

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Faculties extends ActiveRecord
{
	public static function getFaculcyByCathedraId($cath_id)
	{
		$sampleFaculcyInfo_id = Cathedras::findOne($cath_id);
		$sampleFaculcyInfo = Faculties::findOne($sampleFaculcyInfo_id->fac_id);
		
		return $sampleFaculcyInfo;
	}

	public static function getArrayFaculcy()
	{
		$faculcy_list = Faculties::find()
			->select([
				'fac_id',
				'name'
			])
			->all();

		if(!empty($faculcy_list))
		{
			$faculcy_list = ArrayHelper::map($faculcy_list, 'fac_id', 'name');
		}
		return $faculcy_list;
	}
}

?>