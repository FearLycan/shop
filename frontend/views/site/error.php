<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div id="error-page" class="col-md-8 mx-auto text-center">
    <div class="box">
        <p class="text-center">
            <a href="<?= Yii::$app->homeUrl ?>">
                <img src="/img/logo.png" alt="<?= Yii::$app->name ?>">
            </a>
        </p>
        <h3>
            <?= nl2br(Html::encode($message)) ?>
        </h3>

        <h4 class="text-muted">
            <?= Html::encode($this->title) ?>
        </h4>

        <p class="buttons"><a href="<?= Yii::$app->homeUrl ?>" class="btn btn-template-outlined">
                <i class="fa fa-home"></i> Go to Homepage
            </a>
        </p>
    </div>
</div>