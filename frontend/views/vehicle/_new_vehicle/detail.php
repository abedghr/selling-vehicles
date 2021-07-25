<?php


use \yii\widgets\ListView;
use \yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VehicleSearch */
/* @var $vehicle \common\models\Vehicle */
/* @var $breadcrumbs array */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vehicles');
$this->params['breadcrumbs'] = $breadcrumbs;
/*$test = \yii\helpers\ArrayHelper::map($vehicle->vehicleFeatures);*/

?>
<style>
    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
        background-color: #184f7d;
        color: white;
    }
    .nav-tabs .nav-link {
        border-radius: 0px;
    }
</style>
<div class="container">
    <h1><?= $vehicle->title_en ?></h1>
    <p><?= $vehicle->make->title_en . ' - ' . $vehicle->model->title_en . ' - ' . $vehicle->manufacturing_year ?></p>
    <div class="row">
        <div class="col-md-8">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100"
                             src="<?= \yii\helpers\Url::to(Yii::getAlias('@urlManagerBackend') . '/uploads/vehicle/' . $vehicle->main_image) ?>"
                             width="100%" height="450" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100"
                             src="<?= \yii\helpers\Url::to(Yii::getAlias('@urlManagerBackend') . '/uploads/vehicle/' . $vehicle->main_image) ?>"
                             width="100%" height="450" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100"
                             src="<?= \yii\helpers\Url::to(Yii::getAlias('@urlManagerBackend') . '/uploads/vehicle/' . $vehicle->main_image) ?>"
                             width="100%" height="450" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-light h-100 p-4">
                <h2><?= $vehicle->user->company->name_en ?></h2>
                <p class="font-weight-bold" style="font-size: 20px">Retail Price <?= $vehicle->price ?> JOD</p>
                <p class="font-weight-bold" style="font-size: 20px">Company Location: <?= $vehicle->user->location ?></p>
                <p class="font-weight-bold" style="font-size: 20px">Number Of Branches: <?= $vehicle->user->company->branch_number ?></p>
                <button class="btn btn-success btn-block"><i class="fa fa-phone fa-lg"></i> <?= $vehicle->user->phone ?></button>
            </div>
        </div>
        <div class="col-md-8 mt-3 mb-5">
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="false">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                </li>
            </ul>
            <div class="tab-content bg-light" style="height: 200px; margin-top: -12px;" id="myTabContent">
                <div class="container tab-pane fade show active p-3" id="overview" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row mt-3">
                        <div class="col-xs-4 col-sm-4 d-flex align-items-center">
                            <span class="mr-1 font-weight-bold">Body Type:</span><?= $vehicle->bodyType->title_en ?>
                        </div>
                        <div class="col-xs-4 col-sm-4 d-flex align-items-center">
                            <span class="mr-1 font-weight-bold">Gear Box:</span><?= $vehicle->gearBox->title_en ?>
                        </div>
                        <div class="col-xs-4 col-sm-4 d-flex align-items-center">
                            <span class="mr-1 font-weight-bold">Engine:</span><?= $vehicle->newVehicle->engine->title_en ?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-xs-4 col-sm-4 d-flex align-items-center">
                            <span class="mr-1 font-weight-bold">Gasoline Amount:</span><?= $vehicle->newVehicle->gasolineAmount->title_en ?>
                        </div>
                        <div class="col-xs-4 col-sm-4 d-flex align-items-center">
                            <span class="mr-1 font-weight-bold">Wheel Size:</span><?= $vehicle->newVehicle->wheelsSize->title_en ?>
                        </div>
                        <div class="col-xs-4 col-sm-4 d-flex align-items-center">
                            <span class="mr-1 font-weight-bold">Light Type:</span><?= $vehicle->newVehicle->lightType->title_en ?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-xs-4 col-sm-4 d-flex align-items-center">
                            <span class="mr-1 font-weight-bold">Propulsion System:</span><?= $vehicle->newVehicle->propulsionSystem->title_en ?></span>
                        </div>
                        <div class="col-xs-4 col-sm-4 d-flex align-items-center">
                            <span class="mr-1 font-weight-bold">Fuel Type:</span><?= $vehicle->newVehicle->fuelType->title_en ?>
                        </div>
                    </div>
                </div>
                <div class="container tab-pane fade p-3" id="description" role="tabpanel" aria-labelledby="profile-tab">
                    <p style="max-height: 170px; overflow: hidden"><?= $vehicle->description_en ?></p>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <?php foreach ($vehicle->vehicleFeatures as $feature){ ?>
                        <p><?= $feature->taxonomy->title_en ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mb-5">
            <h3 class="border-bottom font-weight-bold">Comments</h3>
            <ul class="list-group border" style="overflow-y: scroll; height: 350px;" >
                <?php foreach ($vehicle_comment as $comment){ ?>
                    <li class="list-group-item">
                        <span style="font-size: 18px;" class="font-weight-bold mb-2"><?= $comment->comment->user->username ?></span> <small><?= $comment->comment->created_at ?></small>
                        <p class="mt-3"><?= $comment->comment->comment ?></p>
                    </li>
                <?php } ?>
            </ul>
            <div class="mt-4">
                <?php $form = \yii\bootstrap4\ActiveForm::begin(); ?>
                <?= $form->field($comments ,'comment')->textarea(['class' => 'form-control'])->label(false) ?>
                <?= Html::submitButton(Yii::t('app', 'Comment'), ['class' => 'btn btn-success']) ?>
                <?php \yii\bootstrap4\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

