<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use common\widgets\Alert;
use \yii\helpers\Url;

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
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap h-100">

    <div class="content d-flex min-vh-100">
        <aside class="w-25 text-light" style="background-color: #0e1c2a">
            <div style="padding: 15px; border-bottom: 1px solid gray;">
                <h4>Dashboard</h4>
                <p>Selling vehicles Admin Dashboard</p>
            </div>
            <ul class="list-group" style="list-style:none; background-color: #0d1d2cc7 !important;">
                <a href="<?= Url::to(['/user/index']) ?>" class="text-light text-decoration-none"><li class="border-bottom" style="padding: 25px 0; margin: 0px 15px; border-bottom-color: gray !important;">Manage User</li></a>
                <a href="<?= Url::to(['/taxonomy/index']) ?>" class="text-light text-decoration-none"><li class="border-bottom" style="padding: 25px 0; margin: 0px 15px; border-bottom-color: gray !important;">Manage Taxonomy</li></a>
                <a href="<?= Url::to(['/vehicle/index']) ?>" class="text-light text-decoration-none"><li class="border-bottom" style="padding: 25px 0; margin: 0px 15px; border-bottom-color: gray !important;">Manage Vehicles</li></a>
            </ul>
        </aside>
        <div class="w-100 d-flex flex-column">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-expand-lg navbar-light border-bottom bg-light',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] =
                    Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                ;
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav ml-auto'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>
            <div class="container-fluid h-100 mt-4">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
            <footer class="footer">
                <div class="container">
                    <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

                    <p class="float-right"><?= Yii::powered() ?></p>
                </div>
            </footer>
        </div>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
