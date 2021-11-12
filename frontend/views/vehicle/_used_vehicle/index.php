<?php


use \yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\VehicleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vehicles');
$this->params['breadcrumbs'] = $breadcrumbs;

?>
<style>

</style>
<div class="container">
    <h3>
        <?php if (isset($make['title_en'])) { ?>
            Used Cars (<?= $make['title_en'] ?>)
        <?php } else { ?>
            All Used Cars
        <?php } ?>
    </h3>
    <div class="vehicle-index d-flex justify-content-center">
        <?= ListView::widget([
            'layout' => "{summary}\n<div class='row'>{items}</div>\n{pager}",
            'dataProvider' => $dataProvider,
            'options' =>['class' =>'w-100'],
            'itemOptions' => ['class' =>'w-100'],

            'itemView' => function ($model){
                return $this->render('list-item',[
                        'data' => $model
                ]);
            },
            'pager' => [
                'options'=>['class'=>'pagination'],   // set clas name used in ui list of pagination
                'prevPageLabel' => '<i class="fa fa-arrow-alt-circle-left"></i> Prev',   // Set the label for the “previous” page button
                'nextPageLabel' => 'Next <i class="fa fa-arrow-alt-circle-right"></i>',   // Set the label for the “next” page button
                'nextPageCssClass'=>'next mx-3',    // Set CSS class for the “next” page button
                'prevPageCssClass'=>'prev mx-3',    // Set CSS class for the “previous” page button
                'maxButtonCount'=>5,    // Set maximum number of page buttons that can be displayed
                'pageCssClass' => 'page-item mx-2',
                'linkOptions' => ['class' => 'page-link'],
                'disabledPageCssClass' => 'page-link',
            ],
        ]); ?>

    </div>
</div>

