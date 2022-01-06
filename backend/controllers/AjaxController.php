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
    /**
     * @return bool
     */
    public function actionFeature()
    {
        if (\Yii::$app->request->isAjax) {
            $make_id = \Yii::$app->request->post()['make_id'];
            $type = \Yii::$app->request->post()['featured_type'];
            $data = Taxonomy::find()->where(['type' => Taxonomy::MAKE, 'id' => $make_id])->one();
            if ($type == 'new') {
                $data->is_featured_new = !$data->is_featured_new;
            } else {
                $data->is_featured_used = !$data->is_featured_used;
            }

            TagDependency::invalidate(\Yii::$app->cache, 'homePageTag');
            return $data->save();
        }
    }
}
