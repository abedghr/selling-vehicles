<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Vehicle */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vehicles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vehicle-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user.username',
            'make.title_en',
            'model.title_en',
            'color.title_en',
            'bodyType.title_en',
            'gearBox.title_en',
            'title',
            'title_en',
            'price',
            'description:ntext',
            'description_en:ntext',
            'type',
            'status',
            'manufacturing_year',
            [
                'attribute' => 'main_image',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img('/uploads/vehicle/' . $model->main_image, ['width' => '250px', 'class' => 'rounded']);
                }
            ],
        ],
    ]) ?>

    <?php if (isset($vehicle_media)) { ?>
        <div class="card mb-3">
            <div class="card-header">
                <h3>Vehicle Images</h3>
            </div>
            <div class="card-body container-fluid pb-5">
                <div class="row">
                    <?php foreach ($vehicle_media as $v_media) { ?>

                        <div class="col-auto mt-4">
                            <a class="bg-info p-1 pl-2 pr-2 rounded" style="position: absolute; top: 10px; right: 27px"><i class="fa fa-eye fa-lg text-light"></i></a>
                            <?= HTML::img('/uploads/vehicle/'.$v_media->media->image,['width'=>'250','height' => '250','class'=>'rounded']) ?>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
