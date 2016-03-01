<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritDoc}
     * @see \yii\base\Model::rules()
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @return boolean
     */
    public function upload()
    {
        //Set the path that the file will be uploaded to
        $path = \Yii::getAlias('@uploads');
        $fileName = md5(date('Y-m-d H:i:s:u'));

        if ($this->validate()) {
            $this->imageFile->saveAs($path . DIRECTORY_SEPARATOR . $fileName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}