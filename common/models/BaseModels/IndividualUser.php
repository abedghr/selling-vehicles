<?php

namespace common\models\BaseModels;

use Yii;

/**
 * This is the model class for table "individual_user".
 *
 * @property int $user_id
 * @property string $first_name
 * @property string $first_name_en
 * @property string $last_name
 * @property string $last_name_en
 *
 * @property User $user
 */
class IndividualUser extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'individual_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'first_name_en', 'last_name', 'last_name_en'], 'required'],
            [['user_id'], 'integer'],
            [['first_name', 'first_name_en', 'last_name', 'last_name_en'], 'string', 'max' => 255],
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
            'first_name' => Yii::t('app', 'First Name'),
            'first_name_en' => Yii::t('app', 'First Name En'),
            'last_name' => Yii::t('app', 'Last Name'),
            'last_name_en' => Yii::t('app', 'Last Name En'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\BaseQuery\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Query\BaseQuery\IndividualUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BaseModels\Query\BaseQuery\IndividualUserQuery(get_called_class());
    }
}
