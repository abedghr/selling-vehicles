<?php

use yii\helpers\Html;

/* @var $model common\models\User */
/* @var $cities array */
/* @var $vehicle_types array */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title . ' ' . $model->type;
?>

<div class="user-create container-fluid">

    <h1 class="mb-3"><?= Html::encode($this->title.' '.$model->type) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cities' => $cities,
        'vehicle_types' => $vehicle_types
    ]) ?>

</div>
