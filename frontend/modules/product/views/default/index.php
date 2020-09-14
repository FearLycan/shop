<?php

use yii\bootstrap4\LinkPager;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\product\models\searches\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row bar">
    <?php Pjax::begin([
        'scrollTo' => true
    ]); ?>
    <div class="col-md-9">
        <p class="text-muted lead">
            In our Ladies department we offer wide selection of the best products we have found
            and carefully selected worldwide. Pellentesque habitant morbi tristique senectus et netuss.
        </p>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_product',
            'options' => [
                'class' => 'row products products-big',
                'route' => 'products'
            ],
            'pager' => [
                'options' => ['class' => 'col-lg-12 text-center'],
                'class' => LinkPager::class,
            ],
            'summary' => false,
            'itemOptions' => ['class' => 'col-lg-4 col-md-6 col-sm-6 col-xs-6'],
        ]); ?>

        <div class="row">
            <div class="col-md-12 banner mb-small"><a href="#">
                    <img src="https://via.placeholder.com/900x245" alt="" class="img-fluid">
                </a>
            </div>
        </div>

    </div>
    <div class="col-md-3 col-sm"></div>
    <?php Pjax::end(); ?>
</div>

<?php



$js = <<<JS

$(document).on('pjax:success', function() {
  $('html, body').animate({
        scrollTop: $('#heading-breadcrumbs').offset().top}, 500);
})
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>


