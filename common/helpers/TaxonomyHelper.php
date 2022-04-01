<?php

namespace common\helpers;

use common\models\Taxonomy;
use yii\base\Component;

class TaxonomyHelper extends Component
{
    public function getAllCity()
    {
        return Taxonomy::find()
            ->where(['type' => Taxonomy::CITY])
            ->asArray()
            ->all();
    }
}