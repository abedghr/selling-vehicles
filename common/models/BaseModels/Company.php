<?php

namespace common\models\BaseModels;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $user_id
 * @property string $name
 * @property string $name_en
 * @property string $vehicles_type
 * @property string|null $image
 * @property string|null $description
 * @property string|null $description_en
 * @property int|null $branch_number
 *
 * @property User $user
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'name_en', 'vehicles_type'], 'required'],
            [['user_id', 'branch_number'], 'integer'],
            [['description', 'description_en'], 'string'],
            [['name', 'name_en', 'vehicles_type'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 500],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'name_en' => Yii::t('app', 'Name En'),
            'vehicles_type' => Yii::t('app', 'Vehicles Type'),
            'image' => Yii::t('app', 'Image'),
            'description' => Yii::t('app', 'Description'),
            'description_en' => Yii::t('app', 'Description En'),
            'branch_number' => Yii::t('app', 'Branch Number'),
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
     * {@inheritdoc}
     * @return \common\models\BaseModels\Query\CompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BaseModels\Query\CompanyQuery(get_called_class());
    }
}
