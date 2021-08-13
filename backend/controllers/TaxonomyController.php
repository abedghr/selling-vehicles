<?php

namespace backend\controllers;

use Yii;
use common\models\Taxonomy;
use common\models\TaxonomySearch;
use yii\caching\TagDependency;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\View;

/**
 * TaxonomyController implements the CRUD actions for Taxonomy model.
 */
class TaxonomyController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        $this->view->registerJs("var base_url = '" . Yii::getAlias('@urlManagerBackend')  . "'", View::POS_HEAD);

        parent::__construct($id, $module, $config);
    }

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
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Taxonomy models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaxonomySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $all_taxonomy = $searchModel->getAllTypes();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'all_taxonomy' => $all_taxonomy
        ]);
    }

    public function actionMakes()
    {
        $searchModel = new TaxonomySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['taxonomy.type' => Taxonomy::MAKE]);
        $all_taxonomy = $searchModel->getAllTypes();

        return $this->render('make', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'all_taxonomy' => $all_taxonomy
        ]);
    }

    /**
     * Displays a single Taxonomy model.
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
     * Creates a new Taxonomy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @var $type string
     */
    public function actionCreate($type)
    {
        $model = new Taxonomy();
        $model->type = $type;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->type == Taxonomy::MAKE){
                TagDependency::invalidate(Yii::$app->cache,'makesListTag');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'type' => $type
        ]);
    }

    /**
     * Updates an existing Taxonomy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $type = $model->type;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'type' => $type
        ]);
    }

    /**
     * Deletes an existing Taxonomy model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);
        $type = $model->type;
        $model->delete();
        if($type == Taxonomy::MAKE) {
            TagDependency::invalidate(Yii::$app->cache,'makesListTag');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Taxonomy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Taxonomy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Taxonomy::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
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
