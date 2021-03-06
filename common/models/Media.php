<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "media".
 *
 * @property int $id
 * @property string $image
 * @property int $user_id
 *
 * @property User $user
 * @property VehicleMedia[] $vehicleMedia
 */
class Media extends \common\models\BaseModels\Media
{
    public $imageFile;
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public function rules()
    {
        return array_merge(parent::rules(),[
            [['imageFile'], 'file', 'extensions' => 'png, jpg','maxFiles' => 6 , 'extensions' => 'png, jpg, jpeg' ,'skipOnEmpty' => false , 'on' => self::SCENARIO_CREATE ],
            [['imageFile'], 'file', 'extensions' => 'png, jpg','maxFiles' => 6 , 'extensions' => 'png, jpg, jpeg' , 'skipOnEmpty' => true , 'on' => self::SCENARIO_UPDATE ],
        ]); // TODO: Change the autogenerated stub
    }

    public function beforeSave($insert)
    {
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
