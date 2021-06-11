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
    <?php foreach ($vehicle_media as $media) { ?>
        <div class="col-auto">
            <?= HTML::img('/uploads/vehicle/'.$media->media->image,['width'=>'100','height' => '100']) ?>
        </div>
    <?php } ?>
</div>
