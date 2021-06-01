<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $user \common\models\IndividualUser|\common\models\Company */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title . ' ' . $model->type;
?>
<div class="user-create container-fluid">

    <h1 class="mb-3"><?= Html::encode($this->title.' '.$model->type) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user
    ]) ?>

</div>
