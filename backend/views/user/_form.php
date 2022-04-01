<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $model common\models\User */
/* @var $cities array */
/* @var $vehicle_types array */

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'type')->textInput(['maxlength' => true , 'readonly'=>true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'phone2')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'city_id')->dropdownList(\yii\helpers\ArrayHelper::map($cities,'id','title_en')) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'status')->dropdownList($model->userStatusList()) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php if ($model->type == \common\models\User::INDVIDUAL_USER_TYPE) { ?>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model->_individual, 'first_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model->_individual, 'first_name_en')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model->_individual, 'last_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model->_individual, 'last_name_en')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

    <?php } ?>
    <?php if ($model->type == \common\models\User::COMPANY_TYPE) { ?>

        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model->_company, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model->_company, 'name_en')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model->_company, 'vehicles_type')->dropdownList($vehicle_types) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model->_company, 'imageFile')->fileInput(['class' => 'form-control']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model->_company, 'description')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model->_company, 'description_en')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?= $form->field($model->_company, 'branch_number')->textInput() ?>
            </div>
        </div>

    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
