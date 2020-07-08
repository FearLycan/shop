<?php

use backend\components\Helper;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searches\StoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-index">

    <div class="row">
        <div class="col-xs-12">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

                    <div class="box-tools pull-right">
                        <?= Html::a('<i class="fa fa-fw fa-plus"></i>Add new store', ['create'], ['class' => 'label label-success']) ?>
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
                        'tableOptions' => ['class' => 'table table-hover'],
                        'options' => ['class' => 'box-body table-responsive no-padding'],
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'contentOptions' => ['style' => 'width: 50px;'],
                            ],
                            'name',
                            [
                                'attribute' => 'status',
                                'contentOptions' => ['style' => 'width: 100px;'],
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Helper::getStatusLabel($model);
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['style' => 'width: 100px; text-align: center;'],
                                'template' => '{new_action1} {new_action2} ',
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
