<?php

namespace frontend\controllers;

use common\models\Comment;
use common\models\Media;
use common\models\Taxonomy;
use common\models\User;
use common\models\Vehicle;
use common\models\VehicleSearch;
use Yii;
use common\models\UsedVehicle;
use yii\filters\AccessControl;
use yii\web\Controller;
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['selling-vehicle', 'models-depends'],
                'rules' => [
                    [
                        'actions' => ['selling-vehicle', 'models-depends'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

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
        $single_vehicle = $vehicles->vehicleUsedDetail($id);

        return $this->render('/vehicle/_used_vehicle/detail', [
            'breadcrumbs' => [
                ['label' => 'Makes','url' => ['/home/make-list-view']],
                ['label' => 'Vehicles','url' => ['vehicle-by-make','id'=>$single_vehicle->make_id]],
                ['label' => $single_vehicle->title_en,'url' => null],
            ],
            'vehicle' => $single_vehicle,
            'comments' => $comments
        ]);
    }

    public function actionSellingVehicle() {

        $model = new Vehicle(['scenario' => Vehicle::SCENARIO_CREATE]);
        $media = new Media(['scenario' => Media::SCENARIO_CREATE]);
        $vehicle_status_list = $model->vehicleStatusList();
        $users = User::find();
        $model->type = Vehicle::TYPE_USED;

        $vehicle = new UsedVehicle();

        $users = $users->all();
        $formData = Yii::$app->request->post();

        if ($model->load($formData) && $vehicle->load($formData) && $media->load($formData)) {
            $model->status = Vehicle::VEHICLE_PENDING;
            $model->user_id = Yii::$app->user->id;
            $create_vehicle = $model->createVehicle($vehicle, $media);
            if ($create_vehicle) {
                return $this->redirect(['vehicle-details', 'id' => $model->id]);
            }
        }

        return $this->render('/vehicle/_used_vehicle/selling-vehicle', [
            'breadcrumbs' => [
                ['label' => 'sell your car','url' => ['/home/index']],
                ['label' => 'sell your car'],
            ],
            'model' => $model,
            'vehicle' => $vehicle,
            'users' => $users,
            'media' => $media,
            'vehicle_status_list' => $vehicle_status_list,
        ]);
    }

    public function actionModelsDepends(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $make_id = $parents[0];
                $models = Taxonomy::findAll([
                    'type' => Taxonomy::MODEL,
                    'parent_id' => $make_id
                ]);
                foreach ($models as $model){
                    $out[] = ['id'=> $model->id , 'name' => $model->title_en];
                }

                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
}
