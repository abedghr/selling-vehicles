<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $type array */
/* @var $model common\models\Taxonomy */

$this->title = Yii::t('app', 'Update Taxonomy: {name}', [
    'name' => $model->title_en,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Taxonomies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="taxonomy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type' => $type
    ]) ?>

</div>
