<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TaxonomySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $all_taxonomy array */

$this->title = Yii::t('app', 'Taxonomies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxonomy-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class'=>'mt-4'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'title_en',
            'type',
            //'image',

            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => 'Featured New',
                'checkboxOptions' => function($dataProvider) {
                    return [
                            'attribute' => 'new',
                            "value" => ($dataProvider['id']) ? $dataProvider['id'] : '',
                            "style" => ($dataProvider['title_en'] == 0) ? '' : 'display:none',
                            "class" => 'featureCheckBox',
                            'checked' => ($dataProvider['is_featured_new']) ? true : false,
                    ];
                 },
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => 'Featured Used',
                'checkboxOptions' => function($dataProvider) {
                    return [
                        'attribute' => 'used',
                        "value" => ($dataProvider['id']) ? $dataProvider['id'] : '',
                        "style" => ($dataProvider['title_en'] == 0) ? '' : 'display:none',
                        "class" => 'featureCheckBox',
                        'checked' => ($dataProvider['is_featured_used']) ? true : false,
                    ];
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
