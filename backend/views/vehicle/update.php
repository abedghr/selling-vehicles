<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vehicle */
/* @var $media common\models\Media */
/* @var $vehicle_media common\models\VehicleMedia */
/* @var $feature common\models\VehicleFeature */

/* @var $users array */
/* @var $features array */
/* @var $vehicle_status_list array */
/* @var $vehicle \common\models\NewVehicle|\common\models\UsedVehicle */

$this->title = Yii::t('app', 'Update Vehicle: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vehicles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="vehicle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'vehicle' => $vehicle,
        'users' => $users,
        'media' => $media,
        'vehicle_media' => $vehicle_media,
        'vehicle_status_list' => $vehicle_status_list,
        'features' => $features,
        'feature' => $feature,
        'create' => 'create'
    ]) ?>

</div>
