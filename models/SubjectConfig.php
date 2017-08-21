<?php 

namespace app\models;

use Yii;
use yii\base\Model;
use yii\bootstrap\Modal;

class SubjectConfig extends Model
{
	public $name;
	public $fac_id;
	public $path;

	function rules()
	{
		return [
			[ ['name', 'fac_id'], 'required', 'message' => 'Обязательное поле для ввода не было заполнено!' ],
			[['name'], 'validateName'],
		];
	}

	public function validateName($attribute, $params)
	{
		$sample_subject = Subjects::findOne(['name' => $this->name]);

		if($sample_subject)
		{
			$this->addError($attribute, 'Такой предмет уже существует!');
		}
	}

	public function save()
	{
		$subject = new Subjects;
		$subject->name = $this->name;
		$subject->fac_id = $this->fac_id;
		$subject->path = Folder::newSubjectPath($this->name);

		return $subject->save();
	}

	public static function getSubjectInfo()
	{
		$info = [
			'total_info' => [
				'count_subjects' => NULL,
				'last_added_subject' => NULL,
			],
			'private_info' => array(),
		];

		$subjects = Subjects::find()
			->all();

		foreach($subjects as $subject)
		{
			$faculcy_name = Faculties::findOne(['fac_id' => $subject->fac_id]);

			$faculties_info = [
				'subject_name' => $subject->name,
				'faculcy_name' => $faculcy_name->name
			];

			array_push($info['private_info'], $faculties_info);
		}

		$info['total_info']['count_subjects'] = count($subjects);

		$last_added_subject = Subjects::find()
			->orderBy([
				'subj_id' => SORT_DESC
			])
			->one();

		$info['total_info']['last_added_subject'] = $last_added_subject->name;

		return $info;
	}
}

?>
