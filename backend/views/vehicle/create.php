<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vehicle */
/* @var $media common\models\Media */
/* @var $feature common\models\VehicleFeature */
/* @var $users array */
/* @var $features array */
/* @var $vehicle_status_list array */

$this->title = Yii::t('app', 'Create Vehicle');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vehicles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'media' => $media,
        'vehicle_status_list' => $vehicle_status_list,
        'features' => $features,
        'feature' => $feature,
        'create' => 'create'
    ]) ?>

</div>
