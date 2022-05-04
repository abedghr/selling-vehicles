<?php

namespace common\helpers;

use yii\base\Component;
use common\models\User;
use common\models\Vehicle;

class UserHelper extends Component
{
    public function getUsersList($type = null)
    {
        $users = User::find();
        if ($type && $type == Vehicle::TYPE_NEW) {
            $users = $users->where(['type' => User::COMPANY_TYPE]);
        }
        $users = $users->all();
        return $users;
    }
}