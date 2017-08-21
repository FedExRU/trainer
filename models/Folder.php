<?php 

namespace app\models;

use Yii;
use yii\base\Model;


class Folder extends Model
{
	public function terminate($dir)
	{
		for($i = 0; $i < count($dir); $i++)
		{
			if(is_dir($dir[$i]))
			{
				self::clear_dir($dir[$i]);
				rmdir($dir[$i]);
			}
		}
	}

	private function myscandir($dir)
	{
	    $list = scandir($dir);
	    unset($list[0],$list[1]);
	    return array_values($list);
	}

	private function clear_dir($dir)
	{
	    $list = self::myscandir($dir);
	    
	    foreach ($list as $file)
	    {
	        if (is_dir($dir.$file))
	        {
	            clear_dir($dir.$file.'/');
	            rmdir($dir.$file);
	        }
	        else
	        {
	            unlink($dir.'/'.$file);
	        }
	    }
	}

	private static function folderName($string)
	{	
		$string = mb_strtolower($string, 'UTF-8');
		$rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    	$lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');

    	return str_replace($rus, $lat, $string);
	}

	public static function newSubjectPath($name)
	{
		$sampleName = self::folderName($name);

		try
		{
			mkdir('./img/demos/'.$sampleName);
			mkdir('./img/practice/'.$sampleName);
			mkdir('./img/testing/'.$sampleName);
		}
		catch(Exception $ex)
		{
			echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
		}

		return $sampleName;
	}
}

?>