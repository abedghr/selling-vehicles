<?php

namespace backend\controllers;

use common\models\Company;
use common\models\IndividualUser;
use common\models\Taxonomy;
use common\models\Vehicle;
use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type)
    {
        $model = new User();
        $taxonomy = new Taxonomy();
        $vehicle = new Vehicle();
        $cities = $taxonomy->getAllCity();
        $vehicle_types = $vehicle->vehicleTypeList();
        $user = null;
        if ($type == User::INDVIDUAL_USER_TYPE) {
            $model->type = $type;
            $user = new IndividualUser();
        }
        if ($type == User::COMPANY_TYPE) {
            $model->type = $type;
            $user = new Company(['scenario'=>Company::SCENARIO_CREATE]);
        }

        $form_data = Yii::$app->request->post();
        if ($model->load($form_data) && $user->load($form_data)) {
            if ($model->registerUser($user))
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user,
            'cities' => $cities,
            'vehicle_types' => $vehicle_types
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = User::find()->where(['id'=>$id])->with('company','individualUser')->one();
        $taxonomy = new Taxonomy();
        $vehicle = new Vehicle();
        $cities = $taxonomy->getAllCity();
        $vehicle_types = $vehicle->vehicleTypeList();
        $user = null;
        if($model->type == User::INDVIDUAL_USER_TYPE){
            $user = $model->individualUser;
        }
        if($model->type == User::COMPANY_TYPE){
            $user = $model->company;
        }
        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            if($model->save() && $user->save()){
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            $transaction->rollBack();
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user,
            'cities' => $cities,
            'vehicle_type' => $vehicle_types
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $delete = $this->findModel($id);
        $delete->is_deleted = 1;
        if($delete->save()){
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
