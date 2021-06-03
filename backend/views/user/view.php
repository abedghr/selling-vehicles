<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->username;
\yii\web\YiiAsset::register($this);

?>
<div class="user-view">

    <h1><?= Html::encode($model->username) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
    $columns = [
        'id',
        'username',
        'email:email',
        'type',
        'phone',
        'phone2',
        'city.title',
        'location',
    ];
    if ($model->type == \common\models\User::INDVIDUAL_USER_TYPE) {
        $all_columns = array_merge($columns, [
            'individualUser.first_name',
            'individualUser.first_name_en',
            'individualUser.last_name',
            'individualUser.last_name_en'
        ]);
    }
    if ($model->type == \common\models\User::COMPANY_TYPE) {
        $all_columns = array_merge($columns, [
            'company.name',
            'company.name_en',
            'company.vehicle_type',
            'company.description',
            'company.description_en',
            'company.branch_number',
            [

                'attribute' => 'image',

                'format' => 'html',

                'label' => 'Image',

                'value' => function ($model) {
                    if($model->company->image) {
                        return Html::img('/uploads/company/' . $model->company->image,
                            ['width' => '250px']);
                    }
                },

            ],
        ]);
    }

    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $all_columns,
    ]) ?>

</div>
