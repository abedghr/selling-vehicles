<?php

namespace common\models;

use common\models\Comment;
use common\models\Company;
use common\models\IndividualUser;
use common\models\Media;
use common\models\Taxonomy;
use common\models\Vehicle;
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
    const SUPER_ADMIN = 'super_admin';
    const ADMIN = 'admin';
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
            self::ADMIN => 'admin',
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
                if($this->type == self::COMPANY_TYPE){
                    if($user->imageFile->saveAs('uploads/company/'. $user->imageFile)){
                        $transaction->commit();
                        return true;
                    }
                    $transaction->rollBack();
                }else{
                    $transaction->commit();
                    return true;
                }
            }
        }
        $transaction->rollBack();
        return false;
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\CommentQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\CompanyQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[IndividualUser]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\IndividualUserQuery
     */
    public function getIndividualUser()
    {
        return $this->hasOne(IndividualUser::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Media]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\MediaQuery
     */
    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\TaxonomyQuery
     */
    public function getCity()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Vehicles]].
     *
     * @return \yii\db\ActiveQuery|\common\models\BaseModels\Query\VehicleQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicle::className(), ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return \common\models\User|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['type' => [self::SUPER_ADMIN, self::ADMIN ],'username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return \common\models\BaseModels\User|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

}
