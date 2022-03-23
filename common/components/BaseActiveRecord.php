<?php

namespace common\components;

use common\models\Media;
use common\models\Vehicle;
use common\models\VehicleMedia;
use Yii;
use yii\web\UploadedFile;

class BaseActiveRecord extends \yii\db\ActiveRecord
{
    public $file_manager;
    public $imageFile;
    public $fileName;

    public function init()
    {
        if($this->file_manager) {
            if($_FILES && isset($_FILES[$this->formName()])) {
                $this->fileName = key($_FILES[$this->formName()]['name']);
            }
        }

        parent::init();
    }

    public function afterFind()
    {
        if ($this->file_manager) {
            if ($this->file_manager['preview']) {
                $this->ImagePreview();
            }
        }

        parent::afterFind();
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $this->uploadImage();
        return parent::save($runValidation, $attributeNames);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->uploadMultiImage();
        parent::afterSave($insert, $changedAttributes);
    }

    public function uploadImage()
    {
        if ($this->file_manager) {
            $attribute = $this->file_manager['attribute'];
            $this->{$attribute} = null;
            $path = $this->file_manager['path'];
            $bucket = $this->file_manager['bucket'];
            $this->imageFile = UploadedFile::getInstance($this, $this->fileName);
            if ($this->imageFile) {

                $image = time() . '_' . $this->imageFile;
                $this->{$attribute} = $image;
                $upload_path = Yii::getAlias('@backend') . '/web/uploads/' . $path;

                if(!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                $save_file_path = $upload_path .'/' . $image;
                if (!$this->imageFile->saveAs($save_file_path)) {
                    return false;
                }

                $s3 = Yii::$app->S3;
                $s3->upload($image, $save_file_path);

                unlink($upload_path . '/' . $image);
            }
        }
        return true;
    }

    public function uploadMultiImage()
    {
        if ($this->file_manager && isset($this->file_manager['multi_image']) && $multi_image = $this->file_manager['multi_image']) {
            $media = new Media();
            $relation = $this->{$this->file_manager['multi_image']['relation']};
            if ($relation) {
                $media->scenario = Media::SCENARIO_UPDATE;
            }

            if ($media->imageFile = UploadedFile::getInstances($media, 'imageFile')) {
                foreach ($media->imageFile as $single_image) {
                    $v_media = new Media(['scenario' => $media->scenario]);
                    $v_media->user_id = Yii::$app->user->id;

                    $v_media->image = $image_name = time() . '_' . $single_image->name;
                    $upload_path = Yii::getAlias('@backend').'/web/uploads/media/';

                    if(!file_exists($upload_path)) {
                        mkdir($upload_path, 0777, true);
                    }

                    if (!$v_media->save()) {
                        return false;
                    }

                    $save_file_path = $upload_path .'/' . $image_name;
                    if (!$single_image->saveAs($save_file_path)) {
                        return false;
                    }

                    $s3 = Yii::$app->S3;
                    $s3->upload($image_name, $save_file_path);

                    unlink($upload_path . '/' . $image_name);

                    $vehicle_media = null;
                    if ($this instanceof Vehicle) {
                        $vehicle_media = new VehicleMedia();
                        $vehicle_media->vehicle_id = $this->id;
                    }
                    $vehicle_media->media_id = $v_media->id;

                    if (!$vehicle_media->save(false)) {
                        return false;
                    }

                }
                return true;
            }
        }
        return true;
    }

    public function ImagePreview()
    {
        if($this->file_manager && $this->file_manager['preview']) {
            $s3 = Yii::$app->S3;
            $attribute = $this->file_manager['attribute'];
            if($this->{$attribute}) {
                $this->{$this->file_manager['preview']} = $s3->getUrl($this->{$attribute});
            }
        }
    }

    public function getS3ImageUrl($image)
    {
        $s3 = Yii::$app->S3;
        return $s3->getUrl($image);
    }

}