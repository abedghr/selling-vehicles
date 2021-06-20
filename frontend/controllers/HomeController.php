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

    public function actionMakeListView($type){
        $makes = '';
        if ($type == Vehicle::TYPE_NEW) {
            $makes = Taxonomy::getAllMakesNew();
        } else {
            $makes = Taxonomy::getAllMakesUsed();
        }

        return $this->render('makes',[
            'breadcrumbs' => [
                ['label' => 'Makes','url' => null],
            ],
            'makes' => $makes,
            'type' => $type
        ]);
    }
}
