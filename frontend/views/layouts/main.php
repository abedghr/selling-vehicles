<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .navbar {
            background-color: #0c1837;
        }
        .navbar a {
            color: white;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="top-header border-bottom border-primary">
    <div class="container">
        <div class="row pt-2 pb-2">
            <div class="col-md-6">
                <span class="font-weight-bold mr-2"> Welcome to Selling Vehicle </span> |
                <span class="ml-2 font-weight-bold">
                    <i class="fa fa-user"></i> <a href="<?= \yii\helpers\Url::to('/site/login') ?>" class="text-dark ">Sign in</a> /
                    <a href="<?= \yii\helpers\Url::to('/site/signup') ?>" class="text-dark">Sign Up</a>
                </span>
            </div>
            <div class="col-md-6 text-right">
                <a href="#" class="text-dark">تصفح باللغة العربية</a>
            </div>
        </div>
    </div>
</div>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => \yii\bootstrap4\Html::img('/images/sv_logo.png',['width' => '25' , 'height' => '25']) . ' Selling Vehicle',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg border-bottom border-to ml-auto',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'options'=>['class'=>'border-left border-right border-secondary'], 'url' => ['/home/index'],'linkOptions' => ['class' =>'mx-3']],
        ['label' => 'All Makes', 'options'=>['class'=>'border-left border-right border-secondary'], 'url' => ['/home/make-list-view'],'linkOptions' => ['class' =>'mx-3']],
        ['label' => 'New Cars', 'options'=>['class'=>'border-left border-right border-secondary'], 'url' => ['/new-vehicle/'],'linkOptions' => ['class' =>'mx-3']],
        ['label' => 'Used Cars', 'options'=>['class'=>'border-left border-right border-secondary'], 'url' => ['/used-vehicle/'],'linkOptions' => ['class' =>'mx-3']],
        ['label' => 'SELL YOUR CAR', 'url' => ['/used-vehicle/vehicle-by-make'],'linkOptions' => ['class' =>'mx-3 px-4 btn btn-primary btn-sm']]
    ];
    if (Yii::$app->user->isGuest) {

    } else {
        $menuItems[] =
            Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm();
    }
    echo Nav::widget([
        'items' => $menuItems,
        'options' => ['class' => 'navbar-nav ml-auto'],
    ]);
    NavBar::end();
    ?>

    <div class="">
        <div style="background-color: #e9ecef">
            <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
