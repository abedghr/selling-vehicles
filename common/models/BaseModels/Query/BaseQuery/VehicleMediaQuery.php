<?php

namespace common\models\BaseModels\Query\BaseQuery;

/**
 * This is the ActiveQuery class for [[\common\models\BaseModels\VehicleMedia]].
 *
 * @see \common\models\BaseModels\VehicleMedia
 */
class VehicleMediaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\VehicleMedia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\VehicleMedia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
