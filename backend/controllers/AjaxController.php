<?php

namespace backend\controllers;

use common\models\Taxonomy;
use yii\caching\TagDependency;
use yii\web\Controller;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class AjaxController extends Controller
{
    public function actionFeature()
    {
        if (\Yii::$app->request->isAjax) {
            $make_id = \Yii::$app->request->post()['make_id'];
            $data = Taxonomy::find()->where(['type' => Taxonomy::MAKE , 'id' => $make_id])->one();
            if($data->is_featured == 0){
                $data->is_featured = 1;
            }else{
                $data->is_featured = 0;
            }
            TagDependency::invalidate(\Yii::$app->cache,'homePageTag');
            return $data->save();
        }
    }
}
