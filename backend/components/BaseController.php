<?php

namespace backend\components;

use Yii;
use yii\web\View;

class BaseController extends \yii\web\Controller
{

    public function __construct($id, $module, $config = [])
    {
        $this->view->registerJs("var base_url = '" . Yii::getAlias('@urlManagerBackend')  . "'", View::POS_HEAD);

        parent::__construct($id, $module, $config);
    }

}