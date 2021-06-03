<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "taxonomy".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $title
 * @property string $title_en
 * @property string $type
 * @property string|null $image
 *
 * @property NewVehicle[] $newVehicles
 * @property NewVehicle[] $newVehicles0
 * @property NewVehicle[] $newVehicles1
 * @property NewVehicle[] $newVehicles2
 * @property NewVehicle[] $newVehicles3
 * @property NewVehicle[] $newVehicles4
 * @property Taxonomy $parent
 * @property Taxonomy[] $taxonomies
 * @property UsedVehicle[] $usedVehicles
 * @property UsedVehicle[] $usedVehicles0
 * @property UsedVehicle[] $usedVehicles1
 * @property User[] $users
 * @property Vehicle[] $vehicles
 * @property Vehicle[] $vehicles0
 * @property Vehicle[] $vehicles1
 * @property Vehicle[] $vehicles2
 * @property Vehicle[] $vehicles3
 * @property VehicleFeature[] $vehicleFeatures
 * @property Vehicle[] $vehicles4
 */
class Taxonomy extends \common\models\BaseModels\Taxonomy
{
    const CITY = 'city';
    const COLOR = 'color';
    const BODY_TYPE = 'body_type';
    const ENGINE = 'engine';
    const ENGINE_CAPACITY = 'engine_capacity';
    const FUEL_TYPE = 'fuel_type';
    const LIGHT_TYPE = 'light_type';
    const PROPULSION_SYSTEM = 'propulsion_system';
    const GASOLINE_AMOUNT = 'gasoline_amount';
    const MILEAGE = 'mileage';
    const VEHICLE_CHECKING = 'vehicle_checking';

    public function getAllTypes()
    {
        return [
            self::CITY => Yii::t('app','city'),
            self::COLOR => Yii::t('app','color'),
            self::BODY_TYPE => Yii::t('app','body type'),
            self::ENGINE => Yii::t('app','engine'),
            self::ENGINE_CAPACITY => Yii::t('app','engine capacity'),
            self::FUEL_TYPE => Yii::t('app','fuel type'),
            self::LIGHT_TYPE => Yii::t('app','light type'),
            self::PROPULSION_SYSTEM => Yii::t('app','propulsion system'),
            self::GASOLINE_AMOUNT => Yii::t('app','gasoline amount'),
            self::MILEAGE => Yii::t('app','mileage'),
            self::VEHICLE_CHECKING => Yii::t('app','vehicle checking'),
        ];
    }

    public function getAllCity()
    {
        return Taxonomy::find()
            ->where(['type' => self::CITY])
            ->asArray()
            ->all();
    }
}
