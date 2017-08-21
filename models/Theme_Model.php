<?php 

namespace app\models;

use Yii;
use yii\base\Model;


class Theme_Model extends Model
{
	public $name;
	public $theme_id;
	public $pass_mark;
	public $dece_mark;
	public $exce_mark;

	function __construct($theme_id = null)
	{
		return $this->theme_id = $theme_id;
	}

	function rules()
	{
		return [
			[['name', 'pass_mark', 'dece_mark', 'exce_mark'], 'required', 'message' => 'Обязательное поле для ввода не было заполнено!'],
			[['pass_mark', 'dece_mark', 'exce_mark'], 'validateMarks'],
			[['exce_mark'], 'validateExceMark'],
			[['pass_mark'], 'validatePassMark'],
			[['dece_mark'], 'validateDeceMark'],
		];
	}

	function validateMarks($attribute, $params)
	{
		if($this->pass_mark == $this->dece_mark && $this->exce_mark == $this->dece_mark && $this->pass_mark == $this->exce_mark)
			$this->addError($attribute, 'Некорректные значения. Минимальные пороги не могут быть равны!');
	}

	function validateExceMark($attribute, $params)
	{
		if($this->exce_mark < $this->pass_mark || $this->exce_mark < $this->dece_mark)
			$this->addError($attribute, 'Порог "Отлично" не может быть меньше остальных значений!');
	}

	function validatePassMark($attribute, $params)
	{
		if($this->pass_mark > $this->exce_mark || $this->pass_mark > $this->dece_mark)
			$this->addError($attribute, 'Порог "Удовлетворительно" не может быть больше остальных значений!');
	}

	function validateDeceMark($attribute, $params)
	{
		if($this->dece_mark < $this->pass_mark || $this->dece_mark > $this->exce_mark)
			$this->addError($attribute, 'Порог "Хорошо" не может быть меньше порога "Удовлетворительно" или больше порога "Отлично"!');
	}

	function validateName($attribute, $params)
	{
		$theme = Themes::find()
			->where(['name' => $this->name])
			->one();

		if($theme != NULL)
			$this->addError($attribute, 'Тема с таким названием уже существует!');
	}

	public function save($subj_id)
	{
		$theme = new Themes();
		$theme->subj_id = $subj_id;
		$theme->mentor_id = Yii::$app->user->getId();
		$theme->name = $this->name;
		$theme->pass_mark = $this->pass_mark;
		$theme->dece_mark = $this->dece_mark;
		$theme->exce_mark = $this->exce_mark;
		$theme->createFolder($this->name);
		$theme->save();

		return true;
	}

	public function edit()
	{
		$theme = Themes::findOne($this->theme_id);

		$theme->name = $this->name;
		$theme->pass_mark = $this->pass_mark;
		$theme->dece_mark = $this->dece_mark;
		$theme->exce_mark = $this->exce_mark;
		$theme->createFolder($this->name);

		$theme->save();

		return true;
	}

}

?>