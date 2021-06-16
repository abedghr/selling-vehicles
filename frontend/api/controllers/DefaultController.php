<?php

namespace app\api\controllers;

use yii\web\Controller;
use Yii;





/**
 * @OA\Info(
 *   version="1.0",
 *   title="Application API",
 *   description="Server - Mobile app API",
 *   @OA\Contact(
 *     name="John Smith",
 *     email="john@example.com",
 *   ),
 * ),
 * @OA\Server(
 *   url="http://frontend.selling-vehicles/api/",
 *   description="main server",
 * )
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => 'genxoft\swagger\ViewAction',
                'apiJsonUrl' => \yii\helpers\Url::to(['api-json'], true),
            ],
            'api-json' => [
                'class' => 'genxoft\swagger\JsonAction',
                'dirs' => [
                    Yii::getAlias('@app/api/controllers'),
                    Yii::getAlias('@app/api/models'),
                ],
            ],
        ];
    }


}
