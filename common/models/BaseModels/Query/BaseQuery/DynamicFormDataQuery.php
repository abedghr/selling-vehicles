<?php

namespace common\models\BaseModels\Query\BaseQuery;

/**
 * This is the ActiveQuery class for [[\common\models\BaseModels\DynamicFormData]].
 *
 * @see \common\models\BaseModels\DynamicFormData
 */
class DynamicFormDataQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\DynamicFormData[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\DynamicFormData|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
