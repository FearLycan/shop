<?php

use frontend\modules\product\models\Product;
use yii\helpers\Url;

/* @var Product $model */


?>

<div class="product">
    <div class="image">
        <a href="<?= Url::to(['view', 'slug' => $model->slug]) ?>">
            <img src="<?= Url::to('@web/images/animated_spinner.webp') ?>" data-src="<?= $model->images[0]->image ?>" alt="<?= $model->title ?>" class="img-fluid image lazy">
        </a>
    </div>
    <div class="text">
        <h3 class="h5">
            <a href="<?= Url::to(['view', 'slug' => $model->slug]) ?>">
                Fur coat with very but very very long name
            </a>
        </h3>
        <p class="price">
            <del>$<?= $model->variants[0]->original_price ?></del>

            $<?= $model->variants[0]->sale_price ?>
        </p>
    </div>
</div>
