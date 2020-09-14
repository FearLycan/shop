<?php

use backend\components\Helper;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searches\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <div class="row">
        <div class="col-xs-12">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

                    <div class="box-tools pull-right">
                        <?php //echo Html::a('<i class="fa fa-fw fa-plus"></i>Create product', ['create'], ['class' => 'label label-success']) ?>
                    </div>
                </div>

                <div class="box-body no-padding">

                    <?php Pjax::begin(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
                        </div>
                    </div>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'contentOptions' => ['style' => 'width: 50px;'],
                            ],
                            [
                                'attribute' => 'title',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a($model->title, ['view', 'id' => $model->id]);
                                },
                                'contentOptions' => ['style' => 'width: 500px;'],
                            ],
                            [
                                'attribute' => 'store_id',
                                'label' => 'Store',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a($model->store->name, ['store/view', 'id' => $model->store->id]);
                                },
                                'contentOptions' => ['style' => 'width: 150px;'],
                            ],
                            [
                                'attribute' => 'category_id',
                                'label' => 'Category',
                                'format' => 'raw',
                                'value' => function ($model) {

                                    if (isset($model->category)) {
                                        return Html::a($model->store->name, ['category/view', 'id' => $model->category->id]);
                                    }

                                    return '<span class="not-set">(not set)</span>';
                                },
                                'contentOptions' => ['style' => 'width: 150px;'],
                            ],
                            [
                                'attribute' => 'status',
                                'contentOptions' => ['style' => 'width: 80px;'],
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Helper::getStatusLabel($model);
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['style' => 'width: 100px; text-align: center;'],
                                'template' => '{new_action3} {new_action4} {new_action5}',
                                'buttons' => [
                                    'new_action3' => function ($url, $model, $key) {
                                        return Html::a(
                                            'Feedback',
                                            ['update', 'id' => $model->id],
                                            ['title' => 'Feedback', 'class' => 'btn btn-success btn-xs']
                                        );
                                    },
                                    'new_action4' => function ($url, $model, $key) {
                                        return Html::a(
                                            'Specification',
                                            ['update', 'id' => $model->id],
                                            ['title' => 'Specification', 'class' => 'btn btn-warning btn-xs', 'style' => 'margin-top: 5px;']
                                        );
                                    },
                                    'new_action5' => function ($url, $model, $key) {
                                        return Html::a(
                                            'Variants',
                                            ['product-variant/product', 'product_id' => $model->id],
                                            ['title' => 'Variants', 'class' => 'btn bg-purple btn-xs', 'style' => 'margin-top: 5px;']
                                        );
                                    },
                                ],
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['style' => 'width: 100px; text-align: center;'],
                                'template' => '{new_action1} {new_action2}',
                                'buttons' => [
                                    'new_action1' => function ($url, $model, $key) {
                                        return Html::a(
                                            'Edit',
                                            ['update', 'id' => $model->id],
                                            ['title' => 'Edit', 'class' => 'btn btn-primary btn-xs']
                                        );
                                    },
                                    'new_action2' => function ($url, $model, $key) {
                                        return Html::a(
                                            'Delete',
                                            ['delete', 'id' => $model->id],
                                            [
                                                'title' => 'Delete', 'class' => 'btn btn-danger btn-xs',
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post',
                                                ],
                                            ]
                                        );
                                    },
                                ],
                            ],
                        ],
                    ]); ?>

                    <?php Pjax::end(); ?>

                </div>

            </div>

        </div>
    </div>

</div>

