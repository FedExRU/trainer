<?php 
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload($question_id)
    {
        $theme_id = Questions::getTheme($question_id);
        $type_id = Questions::getType($question_id);
        $subj_id = Subjects::getIdByThemeId($theme_id);

        $typePath = Types::getPath($type_id);
        $subjPath = Subjects::getPath($subj_id);
        $themePath = Themes::getPath($theme_id);

        $question = Questions::findOne($question_id);
        $question->picture = '/img/'.$typePath.'/'.$subjPath.'/'.$themePath.'/'.$this->imageFile->baseName.'.'. $this->imageFile->extension;
        $question->save();

        if ($this->validate()) 
        {   
            $this->imageFile->saveAs('./img/'.$typePath.'/'.$subjPath.'/'.$themePath.'/'.$this->imageFile->baseName.'.'. $this->imageFile->extension);
            return true;
        } 
        else 
            return false;
    }
}
?>