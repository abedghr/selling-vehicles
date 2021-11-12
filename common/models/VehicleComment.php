<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vehicle_comment".
 *
 * @property int $vehicle_id
 * @property int $comment_id
 *
 * @property Comment $comment
 * @property Vehicle $vehicle
 */
class VehicleComment extends \common\models\BaseModels\Vehicle
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vehicle_id', 'comment_id'], 'required'],
            [['vehicle_id', 'comment_id'], 'integer'],
            [['vehicle_id', 'comment_id'], 'unique', 'targetAttribute' => ['vehicle_id', 'comment_id']],
            [['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['comment_id' => 'id']],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['vehicle_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vehicle_id' => Yii::t('app', 'Vehicle ID'),
            'comment_id' => Yii::t('app', 'Comment ID'),
        ];
    }

    /**
     * Gets query for [[Comment]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\CommentQuery
     */
    public function getComment()
    {
        return $this->hasOne(Comment::className(), ['id' => 'comment_id']);
    }

    /**
     * Gets query for [[Vehicle]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\VehicleQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicle::className(), ['id' => 'vehicle_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Query\VehicleCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BaseModels\Query\VehicleCommentQuery(get_called_class());
    }
}
