<?php

namespace common\models\BaseModels\Query;

/**
 * This is the ActiveQuery class for [[\common\models\BaseModels\Vehicle]].
 *
 * @see \common\models\BaseModels\Vehicle
 */
class VehicleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Vehicle[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Vehicle|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
