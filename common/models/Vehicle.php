<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vehicle".
 *
 * @property int $id
 * @property int $user_id
 * @property int $make_id
 * @property int $model_id
 * @property int $color_id
 * @property int $body_type_id
 * @property int $gear_box_id
 * @property string $title
 * @property string $title_en
 * @property string $price
 * @property string $description
 * @property string $description_en
 * @property string $main_image
 * @property string $type
 * @property string|null $status
 * @property string|null $manufacturing_year
 * @property int|null $is_deleted
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property NewVehicle $newVehicle
 * @property UsedVehicle $usedVehicle
 * @property Taxonomy $bodyType
 * @property Taxonomy $color
 * @property Taxonomy $gearBox
 * @property Taxonomy $make
 * @property Taxonomy $model
 * @property User $user
 * @property VehicleComment[] $vehicleComments
 * @property Comment[] $comments
 * @property VehicleFeature[] $vehicleFeatures
 * @property Taxonomy[] $taxonomies
 * @property VehicleMedia[] $vehicleMedia
 */
class Vehicle extends \common\models\BaseModels\Vehicle
{
    const TYPE_NEW = 'new';
    const TYPE_USED = 'used';

    public function vehicleTypeList(){
        return [
            self::TYPE_NEW => Yii::t('app' , 'new'),
            self::TYPE_USED => Yii::t('app' , 'used')
        ];
    }
}
