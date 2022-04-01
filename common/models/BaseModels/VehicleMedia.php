<?php

namespace common\models\BaseModels;

use Yii;

/**
 * This is the model class for table "vehicle_media".
 *
 * @property int $vehicle_id
 * @property int $media_id
 *
 * @property Media $media
 * @property Vehicle $vehicle
 */
class VehicleMedia extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle_media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'media_id'], 'required'],
            [['vehicle_id', 'media_id'], 'integer'],
            [['media_id'], 'exist', 'skipOnError' => true, 'targetClass' => Media::className(), 'targetAttribute' => ['media_id' => 'id']],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['vehicle_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vehicle_id' => Yii::t('app', 'Vehicle ID'),
            'media_id' => Yii::t('app', 'Media ID'),
        ];
    }

    /**
     * Gets query for [[Media]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\MediaQuery
     */
    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id' => 'media_id']);
    }

    /**
     * Gets query for [[Vehicle]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\VehicleQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicle::className(), ['id' => 'vehicle_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Query\BaseQuery\VehicleMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BaseModels\Query\BaseQuery\VehicleMediaQuery(get_called_class());
    }
}
