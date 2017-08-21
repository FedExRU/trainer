<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Types extends ActiveRecord
{
	public function getPath($type_id)
	{
		$path = Types::findOne($type_id);

		return $path->path;
	}

	public static function getArrayTypes()
	{
		$types = Types::find()
            ->orderBy('type_id DESC')
            ->limit(3)
            ->all();

        if($types != NULL)
        {
        	$types = array_reverse($types);

        	$types = ArrayHelper::map($types, 'type_id', 'name');
        }
        
        return $types;
	}

	public static function getName($type_id)
	{
		$type = Types::findOne($type_id);

		return $type->name;
	}
}

?>