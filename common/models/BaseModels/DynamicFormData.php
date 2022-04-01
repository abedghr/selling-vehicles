<?php

namespace common\models\BaseModels;

use Yii;

/**
 * This is the model class for table "dynamic_form_data".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $data
 * @property string $created_at
 */
class DynamicFormData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dynamic_form_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data'], 'string'],
            [['created_at'], 'safe'],
            [['url'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Query\BaseQuery\DynamicFormDataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BaseModels\Query\BaseQuery\DynamicFormDataQuery(get_called_class());
    }
}
