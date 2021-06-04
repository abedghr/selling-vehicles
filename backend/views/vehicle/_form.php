<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use \yii\helpers\ArrayHelper;
use \common\models\Taxonomy;

/* @var $this yii\web\View */
/* @var $model common\models\Vehicle */
/* @var $vehicle \common\models\NewVehicle|\common\models\UsedVehicle */
/* @var $form yii\widgets\ActiveForm */
/* @var $users array */
?>

<div class="vehicle-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'user_id')->dropdownList(ArrayHelper::map($users, 'id', 'username'),['prompt'=>'Select User']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'make_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::MAKE])->all(), 'id', 'title_en')) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'model_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::MODEL])->all(), 'id', 'title_en')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'color_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::COLOR])->all(), 'id', 'title_en')) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'body_type_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::BODY_TYPE])->all(), 'id', 'title_en')) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'gear_box_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::GEAR_BOX])->all(), 'id', 'title_en')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'description_en')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'main_image')->fileInput(['class' => 'form-control']) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'type')->textInput(['maxlength' => true , 'readonly' => true ]) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'manufacturing_year')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php if($model->type == \common\models\Vehicle::TYPE_NEW){ ?>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($vehicle, 'engine_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::ENGINE])->all(), 'id', 'title_en')) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($vehicle, 'gasoline_amount_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::GASOLINE_AMOUNT])->all(), 'id', 'title_en')) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($vehicle, 'wheels_size_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::WHEELS_SIZE])->all(), 'id', 'title_en')) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($vehicle, 'light_type_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::LIGHT_TYPE])->all(), 'id', 'title_en')) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($vehicle, 'propulsion_system_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::PROPULSION_SYSTEM])->all(), 'id', 'title_en')) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($vehicle, 'fuel_type_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::FUEL_TYPE])->all(), 'id', 'title_en')) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($vehicle, 'video_url')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($vehicle, 'horse_power')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

    <?php } ?>
    <?php if ($model->type ==\common\models\Vehicle::TYPE_USED) { ?>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($vehicle, 'city_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::CITY])->all(), 'id', 'title_en')) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($vehicle, 'mileage_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::MILEAGE])->all(), 'id', 'title_en')) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($vehicle, 'vehicle_checking_id')->dropdownList(ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::VEHICLE_CHECKING])->all(), 'id', 'title_en')) ?>
            </div>
        </div>

    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
