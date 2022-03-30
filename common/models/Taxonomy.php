<?php

namespace common\models;

use Yii;
use yii\caching\TagDependency;
use yii\web\NotFoundHttpException;
use common\behaviors\CacheClearBehavior;
use common\contracts\ShouldClearCache;
use yii\web\UploadedFile;

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
    const MAKE = 'make';
    const MODEL = 'model';
    const YEAR = 'year';
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
    const GEAR_BOX = 'gear_box';
    const WHEELS_SIZE = 'wheels_size';
    const CAMERA = 'camera';
    const SENSOR = 'sensor';
    public $imageFile;

    public function getAllTypes()
    {
        return [
            self::MAKE => Yii::t('app','make'),
            self::MODEL => Yii::t('app','model'),
            self::YEAR => Yii::t('app','year'),
            self::CITY => Yii::t('app','city'),
            self::COLOR => Yii::t('app','color'),
            self::BODY_TYPE => Yii::t('app','body_type'),
            self::ENGINE => Yii::t('app','engine'),
            self::ENGINE_CAPACITY => Yii::t('app','engine_capacity'),
            self::FUEL_TYPE => Yii::t('app','fuel_type'),
            self::LIGHT_TYPE => Yii::t('app','light_type'),
            self::PROPULSION_SYSTEM => Yii::t('app','propulsion_system'),
            self::GASOLINE_AMOUNT => Yii::t('app','gasoline_amount'),
            self::MILEAGE => Yii::t('app','mileage'),
            self::VEHICLE_CHECKING => Yii::t('app','vehicle_checking'),
            self::GEAR_BOX => Yii::t('app','gear_box'),
            self::WHEELS_SIZE => Yii::t('app','wheels_size'),
            self::CAMERA => Yii::t('app','camera'),
            self::SENSOR => Yii::t('app','sensor'),
        ];
    }

    public function getAllCity()
    {
        return Taxonomy::find()
            ->where(['type' => self::CITY])
            ->asArray()
            ->all();
    }

    public static function getAllMakes()
    {
        return \Yii::$app->cache->getOrSet(YII_ENV.':AllMakes:', function () {
            $makes = Taxonomy::find()
                ->where(['taxonomy.type' => self::MAKE])
                ->all();
            if (empty($makes)) {
                throw new NotFoundHttpException('There Is No Data');
            }
            return $makes;
        },3600 * 24,  new TagDependency(['tags' => ['makesNewTag']]));
    }

    public static function getAllMakesNew($featured = null)
    {
        return \Yii::$app->cache->getOrSet(YII_ENV.':AllMakesNew:', function () use ($featured) {

            $makes =  Taxonomy::find()
                ->where(['taxonomy.type' => self::MAKE])
                ->andWhere(['vehicle.type' => Vehicle::TYPE_NEW])
                ->innerJoinWith('vehicles2');
            if($featured) {
                $makes = $makes->where(['is_featured_new' => 1]);
            }
            $makes = $makes->all();

            if (empty($makes)) {
                throw new NotFoundHttpException('There Is No Data');
            }
            return $makes;
        },3600 * 24, new TagDependency(['tags' => ['makesNewTag']]));
    }

    public static function getAllMakesUsed($featured = null)
    {
        $makes = Taxonomy::find()
            ->where(['taxonomy.type' => self::MAKE])
            ->andWhere(['vehicle.type' => Vehicle::TYPE_USED])
            ->innerJoinWith(['vehicles2' => function ($query) {
                return $query->andWhere(['vehicle.type' => Vehicle::TYPE_USED]);
            }]);
            if($featured) {
                $makes = $makes->where(['is_featured_used' => 1]);
            }
            $makes = $makes->all();
            return $makes;
    }

    public function beforeSave($insert)
    {
        $this->imageFile = UploadedFile::getInstance($this,'imageFile');
        if ($this->imageFile) {
            $this->image = time() . '_' . $this->imageFile->name;
            if (!$this->imageFile->saveAs('uploads/' . time() . '_' . $this->imageFile)) {
                return false;
            }
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        TagDependency::invalidate(Yii::$app->cache, [self::className() . '_' . $this->id, 'makesNewTag']);
    }
}
