<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Log extends ActiveRecord
{
	public static function checkLog($log_id)
	{
		$sampleLog = Log::findOne($log_id);
		$sampleLog->is_viewed = '1';

		$sampleLog->save();

		return true;
	}

	public static function checkAll($user_id)
	{
		$sampleLogs = Log::find()
			->where(['user_id' => $user_id])
			->all();

		foreach ($sampleLogs as $sampleLog) 
		{
			$sampleLog->is_viewed = '1';
			$sampleLog->save();
		}
		return true;
	}

	public static function deleteLog($log_id)
	{

		$sampleLog = Log::findOne($log_id);
		$sampleLog->delete();

		return true;
	}

	public static function hasComments($target)
	{
		$hasComments = Log::find()
			->where([
				'target' => $target,
				'is_viewed_comment' => '0',
				'user_id' => Yii::$app->user->getId(),
			])
			->count();

		if($hasComments == 0)
			return 0;
		else
			return 1;
	}

	public static function unsetCommentsNotice($target, $user_id)
	{
		$hasComments = Log::find()
			->where([
				'user_id' => $user_id,
				'target' => $target,
			])
			->all();

		foreach ($hasComments as $sapmleHasComments) 
		{
			$sapmleHasComments->is_viewed_comment = '1';
			$sapmleHasComments->save();
		}
		return true;
	}

	public static function commentWasAdded($number_variant, $user_id, $date)
	{
		$sampleLog = new Log();
		$sampleLog->user_id = $user_id;
		$sampleLog->target = $number_variant;
		$sampleLog->date = $date;
		$sampleLog->is_viewed_comment = 0;
		$sampleLog->text = "В работе с номером варианта ".$number_variant." оставлен комментарий преподавателем.";
		$sampleLog->save();

		return true;
	}

	public static function workWasViewed($sampleStatistics)
	{
		$sampleLog = new Log();
		$sampleLog->user_id = $sampleStatistics->user_id;
		$sampleLog->target = $sampleStatistics->number_variant;
		$sampleLog->date = date("Y-m-d H:i:s"); 
		$sampleLog->text = "Работа с номером варианта ".$sampleStatistics->number_variant." была проверена преподавателем.";
		$sampleLog->save();

		return true;
	}

	public static function workWasCompleted($number_variant, $user_id, $date)
	{
		$sampleLog = new Log();
		$sampleLog->user_id = $user_id;
		$sampleLog->target = $number_variant;
		$sampleLog->date = $date;
		$sampleLog->text = "Работа с номером варианта ".$number_variant." была завершена.";
		$sampleLog->save();

		return true;
	}
}

?>