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
            $type = \Yii::$app->request->post()['featured_type'];
            $data = Taxonomy::find()->where(['type' => Taxonomy::MAKE, 'id' => $make_id])->one();
            if ($type == 'new') {
                if ($data->is_featured_new == 0) {
                    $data->is_featured_new = 1;
                } else {
                    $data->is_featured_new = 0;
                }
            } else {
                if ($data->is_featured_used == 0) {
                    $data->is_featured_used = 1;
                } else {
                    $data->is_featured_used = 0;
                }
            }

            TagDependency::invalidate(\Yii::$app->cache, 'homePageTag');
            return $data->save();
        }
    }
}
