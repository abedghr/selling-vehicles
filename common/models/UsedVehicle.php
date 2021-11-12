<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "used_vehicle".
 *
 * @property int $vehicle_id
 * @property int $city_id
 * @property int $mileage_id
 * @property int $vehicle_checking_id
 *
 * @property Taxonomy $mileage
 * @property Taxonomy $city
 * @property Taxonomy $vehicleChecking
 * @property Vehicle $vehicle
 */
class UsedVehicle extends \common\models\BaseModels\UsedVehicle
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'used_vehicle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'city_id', 'mileage_id', 'vehicle_checking_id'], 'required'],
            [['vehicle_id', 'city_id', 'mileage_id', 'vehicle_checking_id'], 'integer'],
            [['vehicle_id'], 'unique'],
            [['mileage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['mileage_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['vehicle_checking_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['vehicle_checking_id' => 'id']],
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
            'city_id' => Yii::t('app', 'City ID'),
            'mileage_id' => Yii::t('app', 'Mileage ID'),
            'vehicle_checking_id' => Yii::t('app', 'Vehicle Checking ID'),
        ];
    }

    /**
     * Gets query for [[Mileage]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\TaxonomyQuery
     */
    public function getMileage()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'mileage_id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\TaxonomyQuery
     */
    public function getCity()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[VehicleChecking]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\TaxonomyQuery
     */
    public function getVehicleChecking()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'vehicle_checking_id']);
    }

    /**
     * Gets query for [[Vehicle]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\VehicleQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicle::className(), ['id' => 'vehicle_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Query\UsedVehicleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BaseModels\Query\UsedVehicleQuery(get_called_class());
    }
}
