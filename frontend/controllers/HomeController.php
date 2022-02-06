<?php

namespace frontend\controllers;

use common\models\Taxonomy;
use common\models\Vehicle;

/**
 * Home controller
 */
class HomeController extends BaseController
{
    public function actionIndex()
    {
        $new_makes = Taxonomy::getAllMakesNew(true);
        $used_makes = Taxonomy::getAllMakesUsed(true);
        return $this->render('index',[
            'new_makes' => $new_makes,
            'used_makes' => $used_makes
        ]);
    }

    public function actionMakeListView()
    {
        $makes = Taxonomy::getAllMakes();

        return $this->render('makes', [
            'breadcrumbs' => [
                ['label' => 'Makes', 'url' => null],
            ],
            'makes' => $makes,
        ]);
    }

    public function actionMakesByType($type = null) {
        $makes = null;
        if ($type == Vehicle::TYPE_NEW) {
            $makes = Taxonomy::getAllMakesNew();
        } elseif ($type == Vehicle::TYPE_USED) {
            $makes = Taxonomy::getAllMakesUsed();
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
