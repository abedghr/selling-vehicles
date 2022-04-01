<?php

namespace common\models\BaseModels;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property string $type
 * @property string $phone
 * @property string|null $phone2
 * @property int|null $city_id
 * @property string|null $location
 * @property int $status
 * @property int $is_deleted
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $verification_token
 *
 * @property Comment[] $comments
 * @property Company $company
 * @property IndividualUser $individualUser
 * @property Media[] $media
 * @property Taxonomy $city
 * @property Vehicle[] $vehicles
 */
class User extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'type', 'phone'], 'required'],
            [['city_id', 'status', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['type'], 'string', 'max' => 100],
            [['phone', 'phone2'], 'string', 'max' => 15],
            [['location'], 'string', 'max' => 500],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxonomy::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'type' => Yii::t('app', 'Type'),
            'phone' => Yii::t('app', 'Phone'),
            'phone2' => Yii::t('app', 'Phone2'),
            'city_id' => Yii::t('app', 'City ID'),
            'location' => Yii::t('app', 'Location'),
            'status' => Yii::t('app', 'Status'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'verification_token' => Yii::t('app', 'Verification Token'),
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\CommentQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\CompanyQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[IndividualUser]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\IndividualUserQuery
     */
    public function getIndividualUser()
    {
        return $this->hasOne(IndividualUser::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Media]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\MediaQuery
     */
    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\TaxonomyQuery
     */
    public function getCity()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Vehicles]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\VehicleQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicle::className(), ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Query\BaseQuery\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BaseModels\Query\BaseQuery\UserQuery(get_called_class());
    }
}
