<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends \common\models\BaseModels\User
{
    const INDVIDUAL_USER_TYPE = 'individual';
    const COMPANY_TYPE = 'company';

    public function userTypeList(){
        return [
            self::INDVIDUAL_USER_TYPE => 'Individual User',
            self::COMPANY_TYPE => 'Company',
        ];
    }

    public function registerUser(){
        $this->generateAuthKey();
        $this->generateEmailVerificationToken();
        if($this->save())
            return true;
    }
}
