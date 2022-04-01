<?php

namespace common\models\BaseModels;

use Yii;

/**
 * This is the model class for table "taxonomy".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $title
 * @property string $title_en
 * @property string $type
 * @property int|null $is_featured_new
 * @property int|null $is_featured_used
 * @property int|null $is_popular
 * @property string|null $image
 * @property string $created_at
 * @property string $updated_at
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
class Taxonomy extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taxonomy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_featured_new', 'is_featured_used', 'is_popular'], 'integer'],
            [['title', 'title_en', 'type'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'title_en', 'type'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 500],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'title' => Yii::t('app', 'Title'),
            'title_en' => Yii::t('app', 'Title En'),
            'type' => Yii::t('app', 'Type'),
            'is_featured_new' => Yii::t('app', 'Is Featured New'),
            'is_featured_used' => Yii::t('app', 'Is Featured Used'),
            'is_popular' => Yii::t('app', 'Is Popular'),
            'image' => Yii::t('app', 'Image'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[NewVehicles]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\NewVehicleQuery
     */
    public function getNewVehicles()
    {
        return $this->hasMany(NewVehicle::className(), ['engine_id' => 'id']);
    }

    /**
     * Gets query for [[NewVehicles0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\NewVehicleQuery
     */
    public function getNewVehicles0()
    {
        return $this->hasMany(NewVehicle::className(), ['fuel_type_id' => 'id']);
    }

    /**
     * Gets query for [[NewVehicles1]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\NewVehicleQuery
     */
    public function getNewVehicles1()
    {
        return $this->hasMany(NewVehicle::className(), ['gasoline_amount_id' => 'id']);
    }

    /**
     * Gets query for [[NewVehicles2]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\NewVehicleQuery
     */
    public function getNewVehicles2()
    {
        return $this->hasMany(NewVehicle::className(), ['light_type_id' => 'id']);
    }

    /**
     * Gets query for [[NewVehicles3]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\NewVehicleQuery
     */
    public function getNewVehicles3()
    {
        return $this->hasMany(NewVehicle::className(), ['propulsion_system_id' => 'id']);
    }

    /**
     * Gets query for [[NewVehicles4]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\NewVehicleQuery
     */
    public function getNewVehicles4()
    {
        return $this->hasMany(NewVehicle::className(), ['wheels_size_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\TaxonomyQuery
     */
    public function getParent()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Taxonomies]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\TaxonomyQuery
     */
    public function getTaxonomies()
    {
        return $this->hasMany(Taxonomy::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[UsedVehicles]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\UsedVehicleQuery
     */
    public function getUsedVehicles()
    {
        return $this->hasMany(UsedVehicle::className(), ['mileage_id' => 'id']);
    }

    /**
     * Gets query for [[UsedVehicles0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\UsedVehicleQuery
     */
    public function getUsedVehicles0()
    {
        return $this->hasMany(UsedVehicle::className(), ['city_id' => 'id']);
    }

    /**
     * Gets query for [[UsedVehicles1]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\UsedVehicleQuery
     */
    public function getUsedVehicles1()
    {
        return $this->hasMany(UsedVehicle::className(), ['vehicle_checking_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\UserQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['city_id' => 'id']);
    }

    /**
     * Gets query for [[Vehicles]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\VehicleQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicle::className(), ['body_type_id' => 'id']);
    }

    /**
     * Gets query for [[Vehicles0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\VehicleQuery
     */
    public function getVehicles0()
    {
        return $this->hasMany(Vehicle::className(), ['color_id' => 'id']);
    }

    /**
     * Gets query for [[Vehicles1]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\VehicleQuery
     */
    public function getVehicles1()
    {
        return $this->hasMany(Vehicle::className(), ['gear_box_id' => 'id']);
    }

    /**
     * Gets query for [[Vehicles2]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\VehicleQuery
     */
    public function getVehicles2()
    {
        return $this->hasMany(Vehicle::className(), ['make_id' => 'id']);
    }

    /**
     * Gets query for [[Vehicles3]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\VehicleQuery
     */
    public function getVehicles3()
    {
        return $this->hasMany(Vehicle::className(), ['model_id' => 'id']);
    }

    /**
     * Gets query for [[VehicleFeatures]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\VehicleFeatureQuery
     */
    public function getVehicleFeatures()
    {
        return $this->hasMany(VehicleFeature::className(), ['taxonomy_id' => 'id']);
    }

    /**
     * Gets query for [[Vehicles4]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\VehicleQuery
     */
    public function getVehicles4()
    {
        return $this->hasMany(Vehicle::className(), ['id' => 'vehicle_id'])->viaTable('vehicle_feature', ['taxonomy_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Query\BaseQuery\TaxonomyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BaseModels\Query\BaseQuery\TaxonomyQuery(get_called_class());
    }
}
