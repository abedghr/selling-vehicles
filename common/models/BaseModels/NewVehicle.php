<?php

namespace common\models\BaseModels;

use Yii;

/**
 * This is the model class for table "new_vehicle".
 *
 * @property int $vehicle_id
 * @property int $engine_id
 * @property int $gasoline_amount_id
 * @property int $wheels_size_id
 * @property int $light_type_id
 * @property int $propulsion_system_id
 * @property int $fuel_type_id
 * @property string $engine_capacity
 * @property string $video_url
 * @property string $horse_power
 *
 * @property Vehicle $vehicle
 * @property Taxonomy $engine
 * @property Taxonomy $fuelType
 * @property Taxonomy $gasolineAmount
 * @property Taxonomy $lightType
 * @property Taxonomy $propulsionSystem
 * @property Taxonomy $wheelsSize
 */
class NewVehicle extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'new_vehicle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'engine_id', 'gasoline_amount_id', 'wheels_size_id', 'light_type_id', 'propulsion_system_id', 'fuel_type_id', 'engine_capacity', 'video_url', 'horse_power'], 'required'],
            [['vehicle_id', 'engine_id', 'gasoline_amount_id', 'wheels_size_id', 'light_type_id', 'propulsion_system_id', 'fuel_type_id'], 'integer'],
            [['engine_capacity'], 'string', 'max' => 10],
            [['video_url', 'horse_power'], 'string', 'max' => 255],
            [['vehicle_id'], 'unique'],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['vehicle_id' => 'id']],
            [['engine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['engine_id' => 'id']],
            [['fuel_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['fuel_type_id' => 'id']],
            [['gasoline_amount_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['gasoline_amount_id' => 'id']],
            [['light_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['light_type_id' => 'id']],
            [['propulsion_system_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['propulsion_system_id' => 'id']],
            [['wheels_size_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['wheels_size_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vehicle_id' => Yii::t('app', 'Vehicle ID'),
            'engine_id' => Yii::t('app', 'Engine ID'),
            'gasoline_amount_id' => Yii::t('app', 'Gasoline Amount ID'),
            'wheels_size_id' => Yii::t('app', 'Wheels Size ID'),
            'light_type_id' => Yii::t('app', 'Light Type ID'),
            'propulsion_system_id' => Yii::t('app', 'Propulsion System ID'),
            'fuel_type_id' => Yii::t('app', 'Fuel Type ID'),
            'engine_capacity' => Yii::t('app', 'Engine Capacity'),
            'video_url' => Yii::t('app', 'Video Url'),
            'horse_power' => Yii::t('app', 'Horse Power'),
        ];
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
     * Gets query for [[Engine]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\TaxonomyQuery
     */
    public function getEngine()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'engine_id']);
    }

    /**
     * Gets query for [[FuelType]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\TaxonomyQuery
     */
    public function getFuelType()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'fuel_type_id']);
    }

    /**
     * Gets query for [[GasolineAmount]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\TaxonomyQuery
     */
    public function getGasolineAmount()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'gasoline_amount_id']);
    }

    /**
     * Gets query for [[LightType]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\TaxonomyQuery
     */
    public function getLightType()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'light_type_id']);
    }

    /**
     * Gets query for [[PropulsionSystem]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\TaxonomyQuery
     */
    public function getPropulsionSystem()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'propulsion_system_id']);
    }

    /**
     * Gets query for [[WheelsSize]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\TaxonomyQuery
     */
    public function getWheelsSize()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'wheels_size_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Query\BaseQuery\NewVehicleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BaseModels\Query\BaseQuery\NewVehicleQuery(get_called_class());
    }
}
