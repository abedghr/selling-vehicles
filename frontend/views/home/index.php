<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index"

    <div class="jumbotron text-center" style="background-image: url(https://ksa-v3.motory.com/images/homepage/home-main-bg.webp); height: 500px; background-size: 100% 100%; display: flex; align-items: center; justify-content: center;">
        <div class="text-center text-light">
            <h1 class="">Welcome!</h1>
            <p class="lead">Everything you need in one place</p>
            <p class=""><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with SV</a></p>
        </div>
    </div>

    <div class="body-content container" style="margin-top: -100px">

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRosZrqoqV876uZSA5HbKXfJw9r6M5we9WCsw&usqp=CAU" alt="Card image cap">
                    <div class="card-body text-center">
                        <h4 class="card-title">New Cars</h4>
                        <p class="card-text">You can browse all new cars and check if your order is available or not.</p>
                        <a href="<?= \yii\helpers\Url::to(['/home/make-list-view','type' => \common\models\Vehicle::TYPE_NEW]) ?>" class="btn btn-primary">Buy new car</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card rounded">
                    <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRosZrqoqV876uZSA5HbKXfJw9r6M5we9WCsw&usqp=CAU" alt="Card image cap">
                    <div class="card-body text-center">
                        <h4 class="card-title">Used Car</h4>
                        <p class="card-text">You can browse all used cars and check if your order is available or not.</p>
                        <a href="<?= \yii\helpers\Url::to(['/home/make-list-view','type' => \common\models\Vehicle::TYPE_USED]) ?>" class="btn btn-primary">Buy used car</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card rounded">
                    <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRosZrqoqV876uZSA5HbKXfJw9r6M5we9WCsw&usqp=CAU" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title">Sell Cars</h5>
                        <p class="card-text">You can add your car to the website and wait any customer to buy it.</p>
                        <a href="#" class="btn btn-primary">Sell your car</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
