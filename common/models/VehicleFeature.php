<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vehicle_feature".
 *
 * @property int $vehicle_id
 * @property int $taxonomy_id
 *
 * @property Vehicle $vehicle
 * @property Taxonomy $taxonomy
 */
class VehicleFeature extends \common\models\BaseModels\VehicleFeature
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle_feature';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'taxonomy_id'], 'required'],
            [['vehicle_id', 'taxonomy_id'], 'integer'],
            [['vehicle_id', 'taxonomy_id'], 'unique', 'targetAttribute' => ['vehicle_id', 'taxonomy_id']],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['vehicle_id' => 'id']],
            [['taxonomy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['taxonomy_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vehicle_id' => Yii::t('app', 'Vehicle ID'),
            'taxonomy_id' => Yii::t('app', 'Taxonomy ID'),
        ];
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
     * Gets query for [[Taxonomy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\TaxonomyQuery
     */
    public function getTaxonomy()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'taxonomy_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Query\VehicleFeatureQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BaseModels\Query\VehicleFeatureQuery(get_called_class());
    }
}
