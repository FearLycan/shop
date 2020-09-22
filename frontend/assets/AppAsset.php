<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendor/font-awesome/css/font-awesome.min.css',
        'vendor/bootstrap-select/css/bootstrap-select.min.css',
        'vendor/owl.carousel/assets/owl.carousel.css',
        'vendor/owl.carousel/assets/owl.theme.default.css',
        'vendor/photo-swipe/photoswipe.css',
        'vendor/photo-swipe/default-skin/default-skin.css',
        'css/style.default.css',
        'css/site.css',
    ];
    public $js = [
        'vendor/jquery/jquery.min.js',
        'vendor/popper.js/umd/popper.min.js',
        'vendor/bootstrap/js/bootstrap.min.js',
        'vendor/jquery.cookie/jquery.cookie.js',
        'js/jquery.pjax.js',
        'vendor/waypoints/lib/jquery.waypoints.min.js',
        'vendor/jquery.counterup/jquery.counterup.min.js',
        'vendor/owl.carousel/owl.carousel.min.js',
        'vendor/owl.carousel/jquery.mousewheel.min.js',
        'vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js',
        'js/jquery.parallax-1.1.3.js',
        'vendor/bootstrap-select/js/bootstrap-select.min.js',
        'vendor/jquery.scrollto/jquery.scrollTo.min.js',
        'vendor/photo-swipe/photoswipe.js',
        'vendor/photo-swipe/photoswipe-ui-default.js',
        'vendor/jquery.lazy/jquery.lazy.min.js',
        'js/front.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
