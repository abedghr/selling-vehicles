<div class="list-box">
    <main class="py-4">
        <article class="postcard list-item-box text-dark">
            <a class="postcard__img_link" href="#">
                <img src="<?= \yii\helpers\Url::to(Yii::getAlias('@urlManagerBackend') . '/uploads/vehicle/' . $data->main_image) ?>" alt="Image Title" width="500" height="275"/>
            </a>
            <div class="postcard__text">
                <h1 class="postcard__title"><a href="#"><?= $data->title_en ?></a></h1>
                <div class="postcard__subtitle small">
                    <time datetime="" style="font-size: 20px">
                        <i class="fas fa-calendar-alt mr-2"></i><span class="font-weight-bold"><?= $data->manufacturing_year ?></span>
                    </time>
                </div>
                <div class="postcard__bar"></div>
                <div class="postcard__preview-txt"><?= $data->description_en ?></div>
                <ul class="postcard__tagbox">
                    <li class="tag__item"><i class="fas fa-tag mr-2"></i>Make: <?= $data->make->title_en ?></li>
                    <li class="tag__item"><i class="fas fa-tag mr-2"></i>Model: <?= $data->model->title_en ?></li>
                    <li class="tag__item"><i class="fas fa-tag mr-2"></i>City: <?= $data->user->city->title_en ?></li>
                </ul>
                <span style="font-size: 25px;" class="font-weight-bold mt-3">Price: <?= $data->price ?> JOD</span>
                <a href="<?= \yii\helpers\Url::to(['/new-vehicle/vehicle-details/','id' =>$data->id]) ?>" class="btn btn-primary btn-block text-light"><i class="fas fa-eye mr-2"></i>View Details</a>
            </div>
        </article>
    </main>
</div>
