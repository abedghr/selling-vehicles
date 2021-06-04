<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $type string */
/* @var $model common\models\Taxonomy */

$this->title = Yii::t('app', 'Create Taxonomy');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Taxonomies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxonomy-create">

    <h1><?= Html::encode($this->title .' '.'('.$type.')') ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type' => $type
    ]) ?>

</div>
