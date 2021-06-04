<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vehicle */
/* @var $users array */
/* @var $vehicle \common\models\NewVehicle|\common\models\UsedVehicle */

$this->title = Yii::t('app', 'Create Vehicle');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vehicles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'vehicle' => $vehicle,
        'users' => $users
    ]) ?>

</div>
