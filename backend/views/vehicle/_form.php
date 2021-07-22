<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use \yii\helpers\ArrayHelper;
use \common\models\Taxonomy;
use \kartik\depdrop\DepDrop;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Vehicle */
/* @var $media common\models\Media */
/* @var $vehicle \common\models\NewVehicle|\common\models\UsedVehicle */
/* @var $feature \common\models\VehicleFeature */
/* @var $form yii\widgets\ActiveForm */
/* @var $users array */
/* @var $features array */
/* @var $sensor array */
/* @var $vehicle_status_list array */

?>

<div class="vehicle-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'user_id')->dropdownList(ArrayHelper::map($users, 'id', 'username'), ['prompt' => 'Select User']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'make_id')->widget(\kartik\select2\Select2::classname(), [
                'data' => ArrayHelper::map(Taxonomy::find()->where(['type' => Taxonomy::MAKE])->all(), 'id', 'title_en'),
                'options' => ['placeholder' => 'Select a state ...', 'id' => 'make_id'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'model_id')->widget(DepDrop::class, [
                'type' => DepDrop::TYPE_SELECT2,
                'data' => ArrayHelper::map(Taxonomy::findAll(['type' => Taxonomy::MODEL, 'parent_id' => $model->make_id]), 'id', 'title_en'),
                'options' => ['id' => 'model_id'],
                'pluginOptions' => [
                    'depends' => ['make_id'],
                    'url' => Url::to('/taxonomy/models-depends/')
                ]
            ]); ?>
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
            <?= $form->field($model, 'imageFile')->fileInput(['class' => 'form-control']) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($media, 'imageFile[]')->fileInput(['multiple' => true, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'type')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'status')->dropdownList($vehicle_status_list) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'manufacturing_year')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php if ($model->type == \common\models\Vehicle::TYPE_NEW) { ?>

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
            <div class="col-lg-4">
                <?= $form->field($vehicle, 'engine_capacity')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($vehicle, 'video_url')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($vehicle, 'horse_power')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <?php if (isset($create) && $create == 'create') { ?>
            <div class="row">
                <?php foreach (ArrayHelper::map($features, 'id', 'title_en', 'type') as $type => $items) { ?>
                    <div class="col-md-4">
                        <?= $form->field($feature, "features[$type][]")->checkboxList($items)->label($type); ?>
                    </div>
                <?php } ?>
                <div class="col-md-4">
                </div>
            </div>
        <?php } ?>

        <div class="row">
        </div>

    <?php } ?>
    <?php if ($model->type == \common\models\Vehicle::TYPE_USED) { ?>

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

    <?php if (isset($vehicle_media)) { ?>
        <div class="card mb-3">
            <div class="card-header">
                <h3>Vehicle Images</h3>
            </div>
            <div class="card-body container-fluid pb-5">
                <div class="row">
                    <?php foreach ($vehicle_media as $v_media) { ?>

                        <div class="col-auto mt-4">
                            <a href="/vehicle/delete-image?id=<?= $v_media->media->id ?>"
                               class="bg-danger p-2 pl-3 pr-3 rounded"
                               style="position: absolute; top: 10px; right: 27px"
                               onclick="return confirm('Are you sure ?')"><i class="fa fa-trash text-light"></i></a>
                            <?= HTML::img('/uploads/vehicle/' . $v_media->media->image, ['width' => '250', 'height' => '250', 'class' => 'rounded']) ?>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
