<?php
namespace frontend\controllers;

use yii\web\Controller;


/**
 * Home controller
 */
class HomeController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
