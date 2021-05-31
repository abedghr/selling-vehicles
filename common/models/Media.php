<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "media".
 *
 * @property int $id
 * @property string $image
 * @property int $user_id
 *
 * @property User $user
 * @property VehicleMedia[] $vehicleMedia
 */
class Media extends \common\models\BaseModels\Media
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['image'], 'string', 'max' => 500],
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
            'image' => Yii::t('app', 'Image'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
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
     * Gets query for [[VehicleMedia]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\VehicleMediaQuery
     */
    public function getVehicleMedia()
    {
        return $this->hasMany(VehicleMedia::className(), ['media_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Query\MediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BaseModels\Query\MediaQuery(get_called_class());
    }
}
