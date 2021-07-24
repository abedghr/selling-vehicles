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
                ],
            ],
            [
            'class' => PageCache::className(),
            'only' => ['index'],
            'dependency' => [
                'class' => TagDependency::className(),
                'tags' => ['homePageTag']
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $new_makes = Taxonomy::getAllMakesNew(true);
        $used_makes = Taxonomy::getAllMakesUsed(true);
        return $this->render('index',[
            'new_makes' => $new_makes,
            'used_makes' => $used_makes
        ]);
    }

    public function actionMakeListView()
    {
        /*if (($makes = \Yii::$app->cache->get('makesList')) === false) {
            sleep(10);*/

            sleep(5);
            $makes = Taxonomy::getAllMakes();

            /*\Yii::$app->cache->set('makesList', $makes,0, new TagDependency(['tags' => 'makesListTag']));
        }*/

        return $this->render('makes', [
            'breadcrumbs' => [
                ['label' => 'Makes', 'url' => null],
            ],
            'makes' => $makes,
        ]);
    }

    public function actionMakesByType($type = null) {
        $makes = null;
        if ($type == Vehicle::TYPE_NEW) {
            $makes = Taxonomy::getAllMakesNew();
        } elseif ($type == Vehicle::TYPE_USED) {
            $makes = Taxonomy::getAllMakesUsed();
        }

        return $this->render('makes', [
            'breadcrumbs' => [
                ['label' => 'Makes', 'url' => null],
            ],
            'makes' => $makes,
            'type' => $type
        ]);
    }
}
