<?php

namespace frontend\controllers;

use yii\web\Controller;

/**
 * Class AjaxController
 * @package frontend\controllers
 */
class AjaxController extends Controller
{
    public function actionChangeWords()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return [
                'status' => 200,
                'new_content' => [
                    '.get-started' => 'This Is New Content',
                ],
                'remove_classes' => [
                    '.get-started' => 'btn btn-success'
                ],
                'add_classes' => [
                    '.get-started' => 'btn btn-primary'
                ]
            ];
    }
}
