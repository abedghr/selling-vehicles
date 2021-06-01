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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'make_id', 'model_id', 'color_id', 'body_type_id', 'gear_box_id', 'title', 'title_en', 'price', 'description', 'description_en', 'main_image', 'type'], 'required'],
            [['user_id', 'make_id', 'model_id', 'color_id', 'body_type_id', 'gear_box_id', 'is_deleted'], 'integer'],
            [['description', 'description_en'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'title_en'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 30],
            [['main_image'], 'string', 'max' => 500],
            [['type'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 50],
            [['manufacturing_year'], 'string', 'max' => 4],
            [['body_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['body_type_id' => 'id']],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['color_id' => 'id']],
            [['gear_box_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['gear_box_id' => 'id']],
            [['make_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['make_id' => 'id']],
            [['model_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['model_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'make_id' => Yii::t('app', 'Make ID'),
            'model_id' => Yii::t('app', 'Model ID'),
            'color_id' => Yii::t('app', 'Color ID'),
            'body_type_id' => Yii::t('app', 'Body Type ID'),
            'gear_box_id' => Yii::t('app', 'Gear Box ID'),
            'title' => Yii::t('app', 'Title'),
            'title_en' => Yii::t('app', 'Title En'),
            'price' => Yii::t('app', 'Price'),
            'description' => Yii::t('app', 'Description'),
            'description_en' => Yii::t('app', 'Description En'),
            'main_image' => Yii::t('app', 'Main Image'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'manufacturing_year' => Yii::t('app', 'Manufacturing Year'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[NewVehicle]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\NewVehicleQuery
     */
    public function getNewVehicle()
    {
        return $this->hasOne(NewVehicle::className(), ['vehicle_id' => 'id']);
    }

    /**
     * Gets query for [[UsedVehicle]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\UsedVehicleQuery
     */
    public function getUsedVehicle()
    {
        return $this->hasOne(UsedVehicle::className(), ['vehicle_id' => 'id']);
    }

    /**
     * Gets query for [[BodyType]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\TaxonomyQuery
     */
    public function getBodyType()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'body_type_id']);
    }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\TaxonomyQuery
     */
    public function getColor()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'color_id']);
    }

    /**
     * Gets query for [[GearBox]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\TaxonomyQuery
     */
    public function getGearBox()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'gear_box_id']);
    }

    /**
     * Gets query for [[Make]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\TaxonomyQuery
     */
    public function getMake()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'make_id']);
    }

    /**
     * Gets query for [[Model]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\TaxonomyQuery
     */
    public function getModel()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'model_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[VehicleComments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\VehicleCommentQuery
     */
    public function getVehicleComments()
    {
        return $this->hasMany(VehicleComment::className(), ['vehicle_id' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\CommentQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['id' => 'comment_id'])->viaTable('vehicle_comment', ['vehicle_id' => 'id']);
    }

    /**
     * Gets query for [[VehicleFeatures]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\VehicleFeatureQuery
     */
    public function getVehicleFeatures()
    {
        return $this->hasMany(VehicleFeature::className(), ['vehicle_id' => 'id']);
    }

    /**
     * Gets query for [[Taxonomies]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\TaxonomyQuery
     */
    public function getTaxonomies()
    {
        return $this->hasMany(Taxonomy::className(), ['id' => 'taxonomy_id'])->viaTable('vehicle_feature', ['vehicle_id' => 'id']);
    }

    /**
     * Gets query for [[VehicleMedia]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\VehicleMediaQuery
     */
    public function getVehicleMedia()
    {
        return $this->hasMany(VehicleMedia::className(), ['vehicle_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Query\VehicleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BaseModels\Query\VehicleQuery(get_called_class());
    }
}
