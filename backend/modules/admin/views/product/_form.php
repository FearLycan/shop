<?php

use backend\models\Category;
use backend\models\Product;
use backend\models\Store;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">



    <div class="row">
    <div class="col-md-12" style="padding-left: 5px; padding-right: 5px;">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class=""><a href="#tab_1" data-toggle="tab" aria-expanded="false">Product</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Specification</a></li>
                <li class="active"><a href="#tab_3" data-toggle="tab" aria-expanded="true">Variant</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="tab_1">
                    <b>How to use:</b>

                    <p>Exactly like the original bootstrap tabs except you should use
                        the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                    A wonderful serenity has taken possession of my entire soul,
                    like these sweet mornings of spring which I enjoy with my whole heart.
                    I am alone, and feel the charm of existence in this spot,
                    which was created for the bliss of souls like mine. I am so happy,
                    my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                    that I neglect my talents. I should be incapable of drawing a single stroke
                    at the present moment; and yet I feel that I never was a greater artist than now.
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    The European languages are members of the same family. Their separate existence is a myth.
                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                    in their grammar, their pronunciation and their most common words. Everyone realizes why a
                    new common language would be desirable: one could refuse to pay expensive translators. To
                    achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                    words. If several languages coalesce, the grammar of the resulting language is more simple
                    and regular than that of the individual languages.
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="tab_3">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                    sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                    like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
    </div>
    </div>








    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <div class="row">

            <div class="col-md-12">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($model, 'store_id')
                    ->dropDownList(ArrayHelper::map(Store::find()->all(), 'id', 'name'))->label('Store'); ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($model, 'category_id')
                    ->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name'))->label('Category'); ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($model, 'status')
                    ->dropDownList(Product::getStatusNames()); ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($model, 'total_available_quantity')->textInput() ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($model, 'orders')->textInput() ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($model, 'ali_product_id')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-12">
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>

            <div class="col-md-12">
                <?= $form->field($model, 'ali_link')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-12">
                <?= $form->field($model, 'ref')->textInput(['maxlength' => true]) ?>
            </div>

        </div>

        <div class="box-footer">
            <div class="row">
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
