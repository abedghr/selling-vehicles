<?php

/* @var $this yii\web\View */
/* @var $breadcrumbs array */
/* @var $makes \common\models\Taxonomy */
/* @var $type string */

$this->title = 'My Yii Application';
$this->params['breadcrumbs'] = $breadcrumbs;
?>
<div class="container">
    <div class="row">
        <h1 class="col-12 border shadow-sm mt-5 p-3 rounded">Makes List</h1>
    </div>
    <div class="row mt-5">
        <?php foreach ($makes as $make){ ?>
        <div class="col-lg-2 col-sm-3">
            <?php if ($type == \common\models\Vehicle::TYPE_NEW){ ?>
                <a href="<?= \yii\helpers\Url::to(['/new-vehicle/vehicle-by-make', 'id' => $make->id]) ?>">
            <?php }else{ ?>
                    <a href="<?= \yii\helpers\Url::to(['/used-vehicle/vehicle-by-make', 'id' => $make->id]) ?>">
            <?php } ?>
                <div class="card">
                    <img
                            src="https://www.vhv.rs/dpng/d/522-5221969_toyota-logo-symbol-vector-vector-toyota-logo-png.png"
                            class="card-img-top"
                            alt="..."
                    />
                    <div class="card-body">
                        <p class="card-text text-center font-weight-bold">
                           <?= $make->title_en ?>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
</div>
