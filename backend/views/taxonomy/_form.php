<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Taxonomy */
/* @var $type string */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taxonomy-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if ($type == \common\models\Taxonomy::MODEL) { ?>

        <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(\common\models\Taxonomy::find()->where(['type' => \common\models\Taxonomy::MAKE])->all(), 'id', 'title_en')) ?>

    <?php } ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->fileInput(['class' => 'form-control']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
