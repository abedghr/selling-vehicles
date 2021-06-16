<?php

namespace app\api\controllers;

use Codeception\Util\HttpCode;
use common\models\Taxonomy;
use common\models\Vehicle;
use yii\helpers\Json;
use yii\web\Controller;
use Yii;

class HomeController extends Controller
{

    /**
     * @OA\Get(
     *   path                   = "/home/",
     *   summary                = "Home Page List",
     *   tags                   = {"Home Page"},
     *
     *   @OA\Response(
     *     response             = 200,
     *     description          = "Returns all New Cars Suggested Vehicles",
     *   ),
     * )
     */
    public function actionIndex(){
            $list = [];

            $list['makes'] = Taxonomy::getAllMakes();

            $list['suggested_vehicles'] = Vehicle::find()->all();

            return Json::encode($list);

    }
}
