<?php

namespace frontend\controllers;

use common\models\Comment;
use common\models\Vehicle;
use common\models\VehicleSearch;
use Yii;
use common\models\UsedVehicle;
use common\models\UsedVehicleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsedVehicleController implements the CRUD actions for UsedVehicle model.
 */
class UsedVehicleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UsedVehicle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsedVehicleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionVehicleByMake($id)
    {
        $vehicle_search = new VehicleSearch();
        $vehicles = $vehicle_search->search(Yii::$app->request->queryParams,Vehicle::TYPE_USED);
        $vehicles->query->andWhere(['make_id' => $id]);
        return $this->render('/vehicle/_used_vehicle/index',[
            'breadcrumbs' => [
                ['label' => 'Makes','url' => ['/home/make-list-view']],
                ['label' => 'Vehicles','url' => null],
            ],
            'dataProvider' => $vehicles,
        ]);
    }

    public function actionVehicleDetails($id)
    {
        $vehicles = new Vehicle();
        $single_vehicle = $vehicles->vehicleUsedDetail($id);
        $comments = new Comment();
        return $this->render('/vehicle/_used_vehicle/detail',[
            'breadcrumbs' => [
                ['label' => 'Makes','url' => ['/home/make-list-view']],
                ['label' => 'Vehicles','url' => ['vehicle-by-make','id'=>$single_vehicle->make_id]],
                ['label' => $single_vehicle->title_en,'url' => null],
            ],
            'vehicle' => $single_vehicle,
            'comments' => $comments
        ]);

    }
}
