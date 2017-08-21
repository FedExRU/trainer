<?php 

namespace app\models;

use yii\db\ActiveRecord;

class Commentaries extends ActiveRecord
{
        public function Add($number_variant, $text, $date, $user_id)
	{
		$comments = new Commentaries();
                $comments->text = $text;
                $comments->number_variant = $number_variant;
                $comments->date = $date;
                $comments->user_id = $user_id;
                $comments->save();

                return true;
	}
}

?>