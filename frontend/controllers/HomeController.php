<?php

namespace frontend\controllers;

use common\models\Taxonomy;
use common\models\Vehicle;
use yii\caching\DbDependency;
use yii\caching\TagDependency;
use yii\filters\PageCache;
use yii\web\Controller;


/**
 * Home controller
 */
class HomeController extends Controller
{
    public function behaviors()
    {
        return [
            [
            'class' => PageCache::className(),
            'only' => ['make-list-view'],
            'duration' => 170000000,
            'dependency' => [
                'class' => TagDependency::className(),
                'tags' => ['makesListTag']
            ]
        ]];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMakeListView($type = null)
    {
//
//        if (($makes = \Yii::$app->cache->get('makesList')) === false) {
//            sleep(10);
            $makes = '';
            sleep(5);
            if ($type == Vehicle::TYPE_NEW) {
                $makes = Taxonomy::getAllMakesNew();
            } elseif ($type == Vehicle::TYPE_USED) {
                $makes = Taxonomy::getAllMakesUsed();
            } else {
                $makes = Taxonomy::getAllMakes();
            }
//            \Yii::$app->cache->set('makesList', $makes,0, new TagDependency(['tags' => 'makesListTag']));
//        }

        return $this->render('makes', [
            'breadcrumbs' => [
                ['label' => 'Makes', 'url' => null],
            ],
            'makes' => $makes,
            'type' => $type
        ]);
    }
}
