<?php

namespace common\models;

use Yii;
use yii\caching\TagDependency;
use yii\web\UploadedFile;

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
 *
 * @var NewVehicle|UsedVehicle $vehicle
 * @var Media $media
 */
class Vehicle extends \common\models\BaseModels\Vehicle
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const TYPE_NEW = 'new';
    const TYPE_USED = 'used';

    const VEHICLE_ACTIVE = "10";
    const VEHICLE_PENDING = "9";
    const VEHICLE_BLOCKED = "-1";

    public $imageFile;
    public $image_vehicle_preview;
    public $file_manager = [
        'attribute' => 'main_image',
        'preview' => 'image_vehicle_preview',
        'path' => 'vehicle',
        'bucket' => 'vehicle',
        'multi_image' => [
            'relation' => 'vehicleMedia',
        ],
    ];
    public function init()
    {
        parent::init();
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['imageFile'], 'file', 'extensions' => 'png, jpg, jpeg, webp', 'maxFiles' => 1, 'skipOnEmpty' => true, 'on' => self::SCENARIO_UPDATE],
            [['imageFile'], 'file', 'extensions' => 'png, jpg, jpeg, webp', 'maxFiles' => 1, 'skipOnEmpty' => false, 'on' => self::SCENARIO_CREATE],
        ]);
    }

    public function vehicleTypeList()
    {
        return [
            self::TYPE_NEW => Yii::t('app', 'new'),
            self::TYPE_USED => Yii::t('app', 'used')
        ];
    }

    public function vehicleStatusList()
    {
        return [
            9 => self::VEHICLE_PENDING /*Yii::t('app','pending')*/,
            10 => self::VEHICLE_ACTIVE /*Yii::t('app','active')*/,
            -1 => self::VEHICLE_BLOCKED /*Yii::t('app','active')*/,
        ];
    }

    public function createVehicle($vehicle, $feautre = null)
    {
        $transaction = Yii::$app->db->beginTransaction();
        if ($this->save()) {
            if (isset($feautre) && $feautre->features) {
                foreach ($feautre->features as $single_feature) {
                    if ($single_feature) {
                        foreach ($single_feature as $item) {
                            $v_feature = new VehicleFeature();
                            $v_feature->vehicle_id = $this->id;
                            $v_feature->taxonomy_id = $item;
                            if (!$v_feature->save()) {
                                $transaction->rollBack();
                                return false;
                            }
                        }
                    }
                }
            }
            $vehicle->vehicle_id = $this->id;
            if ($vehicle->save()) {
                $transaction->commit();
                return true;
            }
            $transaction->rollBack();
        }
        return false;
    }

    public function updateVehicle($vehicle, $media, $feature = null)
    {
        $transaction = Yii::$app->db->beginTransaction();
        if ($this->save()) {
            if ($feature->features) {
                foreach ($feature->features as $single_feature) {
                    if($single_feature) {
                        foreach ($single_feature as $item) {
                            $v_feature = new VehicleFeature();
                            $v_feature->vehicle_id = $this->id;
                            $v_feature->taxonomy_id = $item;
                            if ($v_feature->isNewRecord && !$v_feature->save()) {
                                $transaction->rollBack();
                                return false;
                            }
                        }
                    }
                }
            }
            $vehicle->vehicle_id = $this->id;
            if ($vehicle->save()) {
                $transaction->commit();
                return true;
            }
            $transaction->rollBack();
        }
        return false;
    }

    public function vehicleList($type)
    {
        $vehicle = new VehicleSearch();
        return $vehicle->search([])->query->JoinWith('newVehicle')->where(['type' => $type]);
    }

    public function vehicleNewDetail($id)
    {
        return Vehicle::find()->where(['id' => $id])
            ->andWhere(['type' => Vehicle::TYPE_NEW])
            ->with([
                'make',
                'model',
                'user',
                'user.company',
                'user.city',
                'newVehicle',
                'vehicleMedia',
                'vehicleMedia.media',
                'bodyType',
                'taxonomies',
                'comments',
                'vehicleFeatures.vehicle',
                'vehicleFeatures.taxonomy',
            ])->one();
    }

    public function vehicleUsedDetail($id)
    {
        return Vehicle::find()->where(['id' => $id])
            ->andWhere(['type' => Vehicle::TYPE_USED])
            ->with([
                'make',
                'model',
                'user',
                'user.individualUser',
                'user.company',
                'user.city',
                'usedVehicle',
                'vehicleMedia',
                'vehicleMedia.media',
                'bodyType',
                'comments',
            ])->one();
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        if(!$insert) {
            /** @var  $single_vehicle Vehicle */
            if(Yii::$app->cache->flush($this->id))
                Yii::$app->cache->set($this->id, $this, 20);
        }
    }

    public function save($runValidation = false, $attributeNames = null)
    {
        return parent::save($runValidation, $attributeNames);
    }

}
