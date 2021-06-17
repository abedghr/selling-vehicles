<div class="list-box">
    <main class="container py-4">
        <article class="postcard list-item-box text-dark">
            <a class="postcard__img_link" href="#">
                <img class="postcard__img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRosZrqoqV876uZSA5HbKXfJw9r6M5we9WCsw&usqp=CAU" alt="Image Title" />
            </a>
            <div class="postcard__text">
                <h1 class="postcard__title"><a href="#"><?= $data->title_en ?></a></h1>
                <div class="postcard__subtitle small">
                    <time datetime="" style="font-size: 20px">
                        <i class="fas fa-calendar-alt mr-2"></i><span class="font-weight-bold"><?= $data->manufacturing_year ?></span>
                    </time>
                </div>
                <div class="postcard__bar"></div>
                <div class="postcard__preview-txt" style="height: 75px;"><?= $data->description_en ?></div>
                <ul class="postcard__tagbox">
                    <li class="tag__item"><i class="fas fa-tag mr-2"></i>Make: <?= $data->make->title_en ?></li>
                    <li class="tag__item"><i class="fas fa-tag mr-2"></i>Model: <?= $data->model->title_en ?></li>
                    <li class="tag__item"><i class="fas fa-tag mr-2"></i>City: <?= $data->user->city->title_en ?></li>
                    <li class="tag__item play red">
                        <a href="#"><i class="fas fa-play mr-2"></i>Play Episode</a>
                    </li>
                </ul>
                <span style="font-size: 25px;" class="font-weight-bold mt-3">Price: <?= $data->price ?> JOD</span>
                <a href="" class="btn btn-primary btn-block text-light"><i class="fas fa-eye mr-2"></i>View Details</a>
            </div>
        </article>
    </main>
</div>
