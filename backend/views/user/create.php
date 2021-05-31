<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="row">
            <?php foreach ($model->userTypeList() as $type){ ?>
                <div class="">
                    <a href="" class="col-auto mt-2 mb-4 mr-2 btn btn-success"><?= Html::encode($type) ?></a>
                </div>
            <?php } ?>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
