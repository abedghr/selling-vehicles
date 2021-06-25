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
    public $features;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(),[
            [['features'], 'safe'],
        ]);
    }


}
