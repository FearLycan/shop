<?php

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="row bar">
    <div class="col-lg-12">
        <p class="lead">Built purse maids cease her ham new seven among and. Pulled coming wooded tended it answer
            remain me be. So landlord by we unlocked sensible it. Fat cannot use denied excuse son law. Wisdom happen
            suffer common the appear ham beauty her had. Or belonging zealously existence as by resources.
        </p>

        <p class="goToDescription">
            <a href="#pills-tab" class="scroll-to text-uppercase">
                Scroll to product details,
                material &amp; care and sizing
            </a>
        </p>

        <div id="productMain" class="row">
            <div class="col-sm-6">
                <div data-slider-id="1" class="owl-carousel shop-detail-carousel owl-loaded owl-drag">

                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            <?php foreach ($model->images as $key => $image): ?>
                                <div class="owl-item">
                                    <div>
                                        <img src="<?= $image->image ?>" alt="" class="img-fluid">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="owl-nav disabled">
                        <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span>
                        </button>
                        <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span>
                        </button>
                    </div>
                    <div class="owl-dots disabled"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box">
                    <form>
                        <div class="sizes">
                            <h3>Available sizes</h3>
                            <div class="dropdown bootstrap-select bs-select"><select class="bs-select" tabindex="-98">
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                                    <option value="large">Large</option>
                                    <option value="x-large">X Large</option>
                                </select>
                                <button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown"
                                        role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox"
                                        aria-expanded="false" title="Small">
                                    <div class="filter-option">
                                        <div class="filter-option-inner">
                                            <div class="filter-option-inner-inner">Small</div>
                                        </div>
                                    </div>
                                </button>
                                <div class="dropdown-menu ">
                                    <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="price">$124.00</p>
                        <p class="text-center">
                            <button type="submit" class="btn btn-template-outlined"><i class="fa fa-shopping-cart"></i>
                                Add to cart
                            </button>
                            <button type="submit" data-toggle="tooltip" data-placement="top" title=""
                                    class="btn btn-default" data-original-title="Add to wishlist"><i
                                        class="fa fa-heart-o"></i></button>
                        </p>
                    </form>
                </div>
                <div data-slider-id="1" class="owl-thumbs">
                    <?php foreach ($model->images as $key => $image): ?>
                        <button data-key="<?= $key ?>" class="owl-thumb-item <?= $key == 0 ? 'active' : '' ?>">
                            <img src="<?= $image->image ?>" alt="" class="img-fluid">
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <ul id="pills-tab" role="tablist" class="nav nav-pills nav-justified box" style="margin-bottom: 20px;">
            <li class="nav-item">
                <a id="pills-home-tab" data-toggle="pill" href="#pills-details" role="tab"
                   aria-controls="pills-home" aria-selected="true" class="nav-link active">
                    Details
                </a>
            </li>

            <li class="nav-item">
                <a id="pills-home-tab" data-toggle="pill" href="#pills-specification" role="tab"
                   aria-controls="pills-home" aria-selected="true" class="nav-link">
                    Specification
                </a>
            </li>

            <li class="nav-item">
                <a id="pills-home-tab" data-toggle="pill" href="#pills-reviews" role="tab"
                   aria-controls="pills-home" aria-selected="true" class="nav-link">
                    Reviews
                </a>
            </li>
        </ul>

        <div id="pills-tabContent" class="tab-content">
            <div id="pills-details" role="tabpanel" aria-labelledby="pills-home-tab" class="tab-pane fade active show">
                <h4 style="text-transform: uppercase;">Product details</h4>
                <?= $model->description ?>
            </div>

            <div id="pills-specification" role="tabpanel" aria-labelledby="pills-home-tab" class="tab-pane fade">
                <h4 style="text-transform: uppercase;">Product Specification</h4>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <dl>
                            <?php foreach ($model->getSpecificationsHalf(1) as $specification): ?>
                                <dt><?= $specification->name ?></dt>
                                <dd><?= $specification->value ?></dd>
                            <?php endforeach; ?>
                        </dl>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <dl>
                            <?php foreach ($model->getSpecificationsHalf(2) as $specification): ?>
                                <dt><?= $specification->name ?></dt>
                                <dd><?= $specification->value ?></dd>
                            <?php endforeach; ?>
                        </dl>
                    </div>
                </div>

            </div>

            <div id="pills-reviews" role="tabpanel" aria-labelledby="pills-home-tab" class="tab-pane fade">
                <h4 style="text-transform: uppercase;">Product reviews</h4>

                <?php foreach ($model->feedbacks as $feedback) : ?>

                    <?php if(!empty($feedback->content)): ?>
                        <div class="media">
                            <img src="https://via.placeholder.com/64" class="mr-3" alt="<?= $feedback->display_name ?>">
                            <div class="media-body">
                                <h5 class="mt-0"><?= $feedback->name ?>
                                    <small>
                                        <?= Yii::$app->formatter->asDate($feedback->date, 'long') ?>
                                    </small>
                                </h5>
                                <?= $feedback->content ?>

                                <?php if (isset($feedback->images)): ?>
                                    <div class="media mt-3">
                                        <?php foreach ($feedback->images as $key => $image): ?>
                                            <a class="mr-3" href="#">
                                                <img src="<?= $image->image ?>" class="img-fluid img-thumbnail mr-3" style="max-height: 80px;"
                                                     alt="Feedback #<?= $feedback->id ?> image #<?= $key ?>">
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>


                            </div>
                        </div>
                        <hr>
                    <?php endif; ?>

                <?php endforeach; ?>


            </div>
        </div>

        <div id="product-social" class="box social text-center mb-5 mt-5">
            <h4 class="heading-light">Show it to your friends</h4>
            <ul class="social list-inline">
                <li class="list-inline-item"><a href="#" data-animate-hover="pulse" class="external facebook"><i
                                class="fa fa-facebook"></i></a></li>
                <li class="list-inline-item"><a href="#" data-animate-hover="pulse" class="external gplus"><i
                                class="fa fa-google-plus"></i></a></li>
                <li class="list-inline-item"><a href="#" data-animate-hover="pulse" class="external twitter"><i
                                class="fa fa-twitter"></i></a></li>
                <li class="list-inline-item"><a href="#" data-animate-hover="pulse" class="email"><i
                                class="fa fa-envelope"></i></a></li>
            </ul>
        </div>

    </div>
</div>
