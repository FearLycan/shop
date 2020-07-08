<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


dmstr\web\AdminLteAsset::register($this);

if (class_exists('backend\assets\AppAsset')) {
    backend\assets\AppAsset::register($this);
}

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - <?= Yii::$app->name ?> </title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <?= $this->render('header.php', [
            'directoryAsset' => $directoryAsset
        ]
    ) ?>

    <?= $this->render('left.php', [
            'directoryAsset' => $directoryAsset
        ]
    ) ?>

    <?= $this->render('content.php', [
            'content' => $content,
            'directoryAsset' => $directoryAsset
        ]
    ) ?>
    <div id="overlay" class="overlay" style="display: none;">
        <div class="overlay__inner">
            <div class="overlay__content"><span class="spinner"></span></div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

