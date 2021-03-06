<?php

namespace backend\controllers;

use common\models\Media;
use common\models\NewVehicle;
use common\models\Taxonomy;
use common\models\UsedVehicle;
use common\models\User;
use common\models\VehicleFeature;
use common\models\VehicleMedia;
use Yii;
use common\models\Vehicle;
use common\models\VehicleSearch;
use yii\caching\TagDependency;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VehicleController implements the CRUD actions for Vehicle model.
 */
class VehicleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Vehicle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VehicleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $vehicle_types = $searchModel->vehicleTypeList();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'vehicle_types' => $vehicle_types
        ]);
    }

    /**
     * Displays a single Vehicle model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $vehicle_media = VehicleMedia::find()->where(['vehicle_id' => $id])->with('media')->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'vehicle_media' => $vehicle_media
        ]);
    }

    /**
     * Creates a new Vehicle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $type
     * @return mixed
     */
    public function actionCreate($type)
    {
        $model = new Vehicle(['scenario' => Vehicle::SCENARIO_CREATE]);
        $media = new Media(['scenario' => Media::SCENARIO_CREATE]);
        $vehicle_status_list = $model->vehicleStatusList();
        $model->type = $type;
        $feature = new VehicleFeature();
        $users = User::find();
        $features = Taxonomy::find()->where(['type' => [Taxonomy::CAMERA, Taxonomy::SENSOR]])->all();


        $vehicle = null;
        if ($type == Vehicle::TYPE_NEW) {
            $users = $users->where(['type' => User::COMPANY_TYPE]);
            $vehicle = new NewVehicle();
        }
        if ($type == Vehicle::TYPE_USED) {
            $vehicle = new UsedVehicle();
        }

        $users = $users->all();
        $formData = Yii::$app->request->post();

        if ($model->load($formData) && $vehicle->load($formData) && $media->load($formData)) {
            if ($feature) {
                $feature->load($formData);
            }
            $create_vehicle = $model->createVehicle($vehicle, $media, $feature);
            if ($create_vehicle) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        return $this->render('create', [
            'model' => $model,
            'vehicle' => $vehicle,
            'users' => $users,
            'media' => $media,
            'vehicle_status_list' => $vehicle_status_list,
            'feature' => $feature,
            'features' => $features
        ]);
    }

    /**
     * Updates an existing Vehicle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $vehicle_media = $model->vehicleMedia;
        $media = new Media(['scenario' => Media::SCENARIO_UPDATE]);

        $feature = new VehicleFeature();
        $features = Taxonomy::find()->where(['type' => [Taxonomy::CAMERA,Taxonomy::SENSOR]])->all();

        $users = User::find();
        $vehicle = null;
        if ($model->type == Vehicle::TYPE_NEW) {
            $users = $users->where(['type' => User::COMPANY_TYPE]);
            $vehicle = $model->newVehicle;
        }
        if ($model->type == Vehicle::TYPE_USED) {
            $vehicle = $model->usedVehicle;
        }

        $users = $users->all();

        $vehicle_status_list = $model->vehicleStatusList();
        $formData = Yii::$app->request->post();
        if ($model->load($formData) && $vehicle->load($formData) && $media->load($formData)) {
            $feature->load($formData);
            if($feature) {
                VehicleFeature::deleteAll(['vehicle_id' => $id]);
            }
            $update = $model->updateVehicle($vehicle, $media, $feature);
            if ($update)
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'vehicle' => $vehicle,
            'users' => $users,
            'media' => $media,
            'vehicle_media' => $vehicle_media,
            'vehicle_status_list' => $vehicle_status_list,
            'features' => $features,
            'feature' => $feature
        ]);
    }

    /**
     * Deletes an existing Vehicle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionDeleteImage($id)
    {
        Media::findOne($id)->delete();
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    /**
     * Finds the Vehicle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vehicle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vehicle::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
