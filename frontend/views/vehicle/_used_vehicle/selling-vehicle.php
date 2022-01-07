<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use \yii\helpers\ArrayHelper;
use \common\models\Taxonomy;
use \kartik\depdrop\DepDrop;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VehicleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $vehicle \common\models\Vehicle */
/* @var $media \common\models\Media */
/* @var $model \common\models\UsedVehicle */

$this->title = Yii::t('app', 'Vehicles');
$this->params['breadcrumbs'] = $breadcrumbs;

?>
<style>

</style>
<div class="container">
    <h3>
        Sell Your Vehicle
    </h3>
    <div class="selling-form-box">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

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
                        'url' => Url::to('/used-vehicle/models-depends/')
                    ]
                ]); ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'manufacturing_year')->textInput(['maxlength' => true]) ?>
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

        <div class="form-group row">
            <div class="col-6">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-block']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

