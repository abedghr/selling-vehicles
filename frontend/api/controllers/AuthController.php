<?php

namespace app\api\controllers;

use Yii;
use app\api\components\BaseController;
use common\models\LoginForm;

class AuthController extends BaseController
{


    /**
     * @OA\SecurityScheme(
     *   securityScheme="bearerAuth",
     *   in="header",
     *   name="bearerAuth",
     *   type="http",
     *   scheme="bearer",
     *   bearerFormat="JWT",
     * ),
     * @OA\Post(
     *   path                   = "/auth/login/",
     *   summary                = "Login",
     *   tags                   = {"Authentication"},
     *
     * @OA\RequestBody(
     *   required               = true,
     *   description            = "Request Params",
     *   @OA\JsonContent(
     *       @OA\Property(
     *         property     = "username",
     *         description  = "Username",
     *         type         = "string",
     *       ),
     *       @OA\Property(
     *         property     = "password",
     *         description  = "Password",
     *         type         = "string",
     *       ),
     *   ),
     * ),
     * @OA\Response(
     *   response             = 200,
     *   description          = "Your application has been successfully submitted",
     * ),
     *     security={
     *     "bearerAuth":{}
     *   }
     * )
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->post(), '');
        if ($model->login()) {

            $user = Yii::$app->user->identity;

            $token = $this->generateJwt($user);

            $this->generateRefreshToken($user);

            Yii::$app->request->headers->set('Authorization', 'Bearer ' . $token);

            return [
                'user' => $user,
                'token' => (string)$token,
            ];
        } else {
            return $model->getFirstErrors();
        }
    }

}