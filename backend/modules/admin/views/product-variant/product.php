<?php

use backend\components\Helper;
use backend\models\Product;
use yii\helpers\Url;

/** @var Product $product */

$this->title = 'Product Variants';

?>


<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Product: <?= $product->title ?>
                </h3>

                <div class="box-tools pull-right">
                </div>

            </div>

            <div class="box-body">
                <h3 class="box-title">Variants</h3>

                <div class="row">

                    <?php foreach ($product->productVariants as $key => $variant) : ?>
                        <div class="col-md-3" id="<?= $variant->id ?>">
                            <div class="box  <?= $variant->isActive() ? 'box-success' : 'box-danger' ?> ">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Variant #<?= ($key + 1) ?></h3>

                                    <div class="box-tools pull-right" data-toggle="tooltip" title=""
                                         data-original-title="Status">
                                        <div class="btn-group" data-toggle="btn-toggle">
                                            <button data-status="1" data-variant-id="<?= $variant->id ?>" type="button"
                                                    class="status btn btn-default btn-sm <?= !$variant->isActive() ?: 'active' ?>" title="Active">
                                                <i class="fa fa-square text-green"></i>
                                            </button>
                                            <button data-status="0" type="button" data-variant-id="<?= $variant->id ?>"
                                                    class="status btn btn-default btn-sm <?= $variant->isActive() ?: 'active' ?>" title="Inactive">
                                                <i class="fa fa-square text-red"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-body">
                                    <div class="table-responsive" id="variant<?= $variant->id ?>">

                                        <table class="table">
                                            <tr>
                                                <th>Name</th>
                                                <td><?= $variant->name ?></td>
                                            </tr>
                                            <tr>
                                                <th>Display Name</th>
                                                <td><?= $variant->display_name ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td><?= Helper::getStatusLabel($variant) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Original price</th>
                                                <td>$<?= $variant->original_price ?></td>
                                            </tr>
                                            <tr>
                                                <th>Sale price</th>
                                                <td>$<?= $variant->sale_price ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <img class="img-responsive" src="<?= $variant->image ?>">
                                                </td>
                                            </tr>
                                        </table>

                                    </div>

                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>


                </div>

            </div>

        </div>
    </div>
</div>

<?php

$url = Url::to(['product-variant/change-status']);

$js = <<<JS
     $( "button.status" ).on( "click", function() {
      
         if(!$(this).hasClass('active')){
             
             let button = this;
             
             let status = $(this).data('status');
             let id = $(this).data('variant-id');
                       
             $.ajax({
                type: "POST",
                url: "{$url}",
                data: {'status': status, 'id':id},
                success:function(data) {
                      
                    if(data === 'ok'){
                                                
                        $(button).parent('div.btn-group').find('.active').removeClass('active');
                        $(button).addClass('active');
                        
                        let box = $('div#'+id+ ' div.box');
                        let label = $(box).find('span.label');
                        
                        $(box).removeClass('box-success box-danger');
                        $(label).removeClass('label-success label-danger');
                        
                        if(status){
                            $(box).addClass('box-success');
                            $(label).addClass('label-success').text('ACTIVE');
                        }else {
                            $(box).addClass('box-danger');
                            $(label).addClass('label-danger').text('INACTIVE');
                        }
                    }
                    
                }
             });
         }
    }); 
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>


