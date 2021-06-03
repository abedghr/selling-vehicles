<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

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
 * @property Company|User $user write-only password
 */
class User extends \common\models\BaseModels\User
{
    const INDVIDUAL_USER_TYPE = 'individual';
    const COMPANY_TYPE = 'company';

    public function userStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app','active'),
            self::STATUS_INACTIVE => Yii::t('app','inactive')
        ];
    }

    public function userTypeList()
    {
        return [
            self::INDVIDUAL_USER_TYPE => 'individual',
            self::COMPANY_TYPE => 'company',
        ];
    }

    public function registerUser($user)
    {
        if($this->type == self::COMPANY_TYPE){
            $user->imageFile = UploadedFile::getInstance($user , 'imageFile');
            $user->image = $user->imageFile->name;
        }
        $transaction = Yii::$app->db->beginTransaction();
        $this->setPassword($this->password_hash);
        $this->generateAuthKey();
        $this->generateEmailVerificationToken();
        if ($this->save()) {
            $user->user_id = $this->id;
            if ($user->save()) {
                if($user->imageFile->saveAs('uploads/company/'. $user->imageFile)){
                    $transaction->commit();
                    return true;
                }
            $transaction->rollBack();
            }
        }
        $transaction->rollBack();
        return false;
    }
}
