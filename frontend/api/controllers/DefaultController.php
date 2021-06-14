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
 *   url="https://example.com/api",
 *   description="main server",
 * )
 * @OA\Server(
 *   url="https://dev.example.com/api",
 *   description="dev server",
 * )
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'index' => [
                'class' => 'genxoft\swagger\ViewAction',
                'apiJsonUrl' => \yii\helpers\Url::to(['api-json'], true),
            ],
            'api-json' => [
                'class' => 'genxoft\swagger\JsonAction',
                'dirs' => [
                    Yii::getAlias('app\api\controllers'),
                    Yii::getAlias('app\api\models'),
                ],
            ],
        ];
    }


}
