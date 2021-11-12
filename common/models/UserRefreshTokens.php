<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_refresh_tokens".
 *
 * @property int $user_refresh_tokenID
 * @property int $urf_userID
 * @property string $urf_token
 * @property string $urf_ip
 * @property string $urf_user_agent
 * @property string $urf_created UTC
 */
class UserRefreshTokens extends BaseModels\UserRefreshTokens
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(),[]);
    }

}
