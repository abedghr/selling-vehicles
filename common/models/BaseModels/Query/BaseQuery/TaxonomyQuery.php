<?php

namespace common\models\BaseModels\Query\BaseQuery;

/**
 * This is the ActiveQuery class for [[\common\models\BaseModels\Taxonomy]].
 *
 * @see \common\models\BaseModels\Taxonomy
 */
class TaxonomyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Taxonomy[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BaseModels\Taxonomy|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
