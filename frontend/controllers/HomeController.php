<?php

namespace frontend\controllers;

use common\models\Taxonomy;
use common\models\Vehicle;
use yii\web\Controller;


/**
 * Home controller
 */
class HomeController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMakeListView($type = null)
    {

        if (($makes = \Yii::$app->cache->get('makesList')) === false) {
            $makes = '';
            if ($type == Vehicle::TYPE_NEW) {
                $makes = Taxonomy::getAllMakesNew();
            } elseif ($type == Vehicle::TYPE_USED) {
                $makes = Taxonomy::getAllMakesUsed();
            } else {
                $makes = Taxonomy::getAllMakes();
            }
            \Yii::$app->cache->set('makesList', $makes);
        }

        return $this->render('makes', [
            'breadcrumbs' => [
                ['label' => 'Makes', 'url' => null],
            ],
            'makes' => $makes,
            'type' => $type
        ]);
    }
}
