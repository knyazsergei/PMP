<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadImage extends Model{

	public $image;

	public function rules(){
		return[
			[['image'], 'file', 'extensions' => 'png, jpg'],
		];
	}

	public function upload($name){
		if($this->validate()){
			$fileName = "{$name}.{$this->image->extension}";
			$this->image->saveAs("uploads/{$fileName}");
			return $fileName;
		}else{
			return "";
		}
	}

}