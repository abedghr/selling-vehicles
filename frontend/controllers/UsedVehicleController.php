<?php

namespace frontend\controllers;

use common\models\Comment;
use common\models\Taxonomy;
use common\models\Vehicle;
use common\models\VehicleSearch;
use Yii;
use common\models\UsedVehicle;
use common\models\UsedVehicleSearch;
use yii\caching\TagDependency;
use yii\filters\PageCache;
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
            ]
        ];
    }

    /**
     * Lists all UsedVehicle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $vehicle_search = new VehicleSearch();
        $vehicles = $vehicle_search->search(Yii::$app->request->queryParams,Vehicle::TYPE_USED);
        return $this->render('/vehicle/_used_vehicle/index',[
            'breadcrumbs' => [
                ['label' => 'Vehicles','url' => null],
            ],
            'dataProvider' => $vehicles,
        ]);
    }

    public function actionVehicleByMake($id)
    {
        $vehicle_search = new VehicleSearch();
        $vehicles = $vehicle_search->search(Yii::$app->request->queryParams,Vehicle::TYPE_USED);
        $vehicles->query->andWhere(['make_id' => $id]);
        $make = Taxonomy::find()->where(['id' => $id])->select(['title_en' , 'title'])->asArray()->one();
        return $this->render('/vehicle/_used_vehicle/index',[
            'breadcrumbs' => [
                ['label' => 'Makes','url' => ['/home/make-list-view']],
                ['label' => 'Vehicles','url' => null],
            ],
            'dataProvider' => $vehicles,
            'make' => $make
        ]);
    }

    public function actionVehicleDetails($id)
    {
        $vehicles = new Vehicle();
        $comments = new Comment();
        $single_vehicle = Yii::$app->cache->get($id);
        if($single_vehicle === false) {
            $single_vehicle = $vehicles->vehicleUsedDetail($id);
            Yii::$app->cache->set($id, $single_vehicle, 20, new TagDependency());
            sleep(3);
        }
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
