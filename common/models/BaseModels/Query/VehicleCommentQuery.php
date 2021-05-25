<?php

namespace common\models\BaseModels\Query;

/**
 * This is the ActiveQuery class for [[\common\models\BaseModels\VehicleComment]].
 *
 * @see \common\models\BaseModels\VehicleComment
 */
class VehicleCommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\VehicleComment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\VehicleComment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
