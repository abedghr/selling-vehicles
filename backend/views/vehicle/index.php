<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $vehicle_types array */
/* @var $searchModel common\models\VehicleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vehicles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach ($vehicle_types as $type){ ?>
        <?= Html::a('Vehicle '.$type, ['create','type'=>$type], ['class' => 'btn btn-success']) ?>
    <?php } ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class'=>'mt-4'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user',
                'value' => 'user.username'
            ],
            [
                'attribute' => 'make',
                'value' => 'make.title_en'
            ],
            [
                'attribute' => 'model',
                'value' => 'model.title_en'
            ],
            //'color_id',
            //'body_type_id',
            //'gear_box_id',
            //'title',
            //'title_en',
            //'price',
            //'description:ntext',
            //'description_en:ntext',
            //'main_image',
            'type',
            //'status',
            //'manufacturing_year',
            //'is_deleted',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
