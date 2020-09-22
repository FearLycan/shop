<?php

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

use yii\helpers\Url; ?>


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
                                <div class="owl-item slide">
                                    <div>
                                        <img src="<?= $image->image ?>" alt="" class="img-fluid">
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <?php foreach ($model->variants as $key => $variant): ?>
                                <div class="owl-item variant" id="variant<?= $key ?>">
                                    <div>
                                        <img src="<?= $variant->image ?>" alt="" class="img-fluid">
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
                            <h3>Variants</h3>
                            <div class="row variants">
                                <?php foreach ($model->variants as $key => $variant): ?>
                                    <div class="col-md-3">
                                        <img src="<?= $variant->image ?>" data-id="variant<?= $key ?>"
                                             class="img-fluid variant">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <p class="price">
                            $<?= $model->variants[0]->sale_price ?>
                        </p>
                        <p class="text-center">
                            <a href="#" type="submit" class="btn btn-template-outlined">
                                <i class="fa fa-shopping-cart"></i>
                                Buy it Now
                            </a>
                            <a href="#" type="submit" data-toggle="tooltip" data-placement="top" title="Add to wishlist"
                               class="btn btn-default" data-original-title="Add to wishlist">
                                <i class="fa fa-heart-o"></i></a>
                        </p>
                    </form>
                </div>
                <div data-slider-id="1" class="owl-thumbs">
                    <?php foreach ($model->images as $key => $image): ?>
                        <button class="owl-thumb-item">
                            <img src="<?= Url::to('@web/images/animated_spinner.webp') ?>"
                                 data-src="<?= $image->image ?>" alt="" class="img-fluid lazy">
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

                    <?php if (!empty($feedback->content)): ?>
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
                                    <div class="media mt-3 gallery">
                                        <?php foreach ($feedback->images as $key => $image): ?>
                                            <a class="mr-3" href="<?= $image->image ?>"
                                               data-med="<?= $image->image ?>"
                                               data-author="<?= $feedback->name ?>">
                                                <img data-src="<?= $image->image ?>"
                                                     src="<?= Url::to('@web/images/animated_spinner.webp') ?>"
                                                     class="img-fluid img-thumbnail mr-3 lazy" style="max-height: 80px;"
                                                     alt="Feedback #<?= $feedback->id ?> image #<?= $key ?>">
                                                <figure><?= $feedback->content ?></figure>
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


<?php
$js = <<<JS

$( ".variants" ).on( "click", "img", function() {
  $('img.variant.active').removeClass('active');
  $('.owl-item.active').removeClass('active');
  $('.owl-thumb-item.active').removeClass('active');
  
  $(this).addClass('active');
  
  let id = $(this).data('id');
  
  let target = $('#'+id);
  $('.owl-carousel').trigger("to.owl.carousel", [$(target).index(), 250]);
});

function getSize(url) {
  const img = new Image();
  img.onload = function(size) {
     //[this.width, this.height];
  };
  img.src = url;
  return [img.width, img.height];
}


         (function() {

		var initPhotoSwipeFromDOM = function(gallerySelector) {

			var parseThumbnailElements = function(el) {
			    var thumbElements = el.childNodes,
			        numNodes = thumbElements.length,
			        items = [],
			        el,
			        childElements,
			        thumbnailEl,
			        size = [],
			        item;

			    for(var i = 0; i < numNodes; i++) {
			        el = thumbElements[i];

			        // include only element nodes 
			        if(el.nodeType !== 1) {
			          continue;
			        }

			        childElements = el.children;

                    let src = el.children[0].getAttribute('src');

			       // size = el.getAttribute('data-size').split('x');
			       let size = [];
			       size = getSize(src);
   
			        // create slide object
			        item = {
						src: el.getAttribute('href'),
						w: parseInt(size[0], 10),
						h: parseInt(size[1], 10),
						author: el.getAttribute('data-author')
			        };

			        item.el = el; // save link to element for getThumbBoundsFn

			        if(childElements.length > 0) {
			          item.msrc = childElements[0].getAttribute('src'); // thumbnail url
			          if(childElements.length > 1) {
			              item.title = childElements[1].innerHTML; // caption (contents of figure)
			          }
			        }


					var mediumSrc = el.getAttribute('data-med');
		          	if(mediumSrc) {
		            	
		            	let size = [];
		            	
		            	let src = el.getAttribute('href');
		            	
                        size = getSize(src);
                                                
		            	// "medium-sized" image
		            	item.m = {
		              		src: mediumSrc,
		              		w: parseInt(size[0], 10),
		              		h: parseInt(size[1], 10)
		            	};
		          	}
		          	// original image
		          	item.o = {
		          		src: item.src,
		          		w: item.w,
		          		h: item.h
		          	};

			        items.push(item);
			    }

			    return items;
			};

			// find nearest parent element
			var closest = function closest(el, fn) {
			    return el && ( fn(el) ? el : closest(el.parentNode, fn) );
			};

			var onThumbnailsClick = function(e) {
			    e = e || window.event;
			    e.preventDefault ? e.preventDefault() : e.returnValue = false;

			    var eTarget = e.target || e.srcElement;

			    var clickedListItem = closest(eTarget, function(el) {
			        return el.tagName === 'A';
			    });

			    if(!clickedListItem) {
			        return;
			    }

			    var clickedGallery = clickedListItem.parentNode;

			    var childNodes = clickedListItem.parentNode.childNodes,
			        numChildNodes = childNodes.length,
			        nodeIndex = 0,
			        index;

			    for (var i = 0; i < numChildNodes; i++) {
			        if(childNodes[i].nodeType !== 1) { 
			            continue; 
			        }

			        if(childNodes[i] === clickedListItem) {
			            index = nodeIndex;
			            break;
			        }
			        nodeIndex++;
			    }

			    if(index >= 0) {
			        openPhotoSwipe( index, clickedGallery );
			    }
			    return false;
			};

			var photoswipeParseHash = function() {
				var hash = window.location.hash.substring(1),
			    params = {};

			    if(hash.length < 5) { // pid=1
			        return params;
			    }

			    var vars = hash.split('&');
			    for (var i = 0; i < vars.length; i++) {
			        if(!vars[i]) {
			            continue;
			        }
			        var pair = vars[i].split('=');  
			        if(pair.length < 2) {
			            continue;
			        }           
			        params[pair[0]] = pair[1];
			    }

			    if(params.gid) {
			    	params.gid = parseInt(params.gid, 10);
			    }

			    return params;
			};

			var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
			    var pswpElement = document.querySelectorAll('.pswp')[0],
			        gallery,
			        options,
			        items;

				items = parseThumbnailElements(galleryElement);

			    // define options (if needed)
			    options = {

			        galleryUID: galleryElement.getAttribute('data-pswp-uid'),

			        getThumbBoundsFn: function(index) {
			            // See Options->getThumbBoundsFn section of docs for more info
			            var thumbnail = items[index].el.children[0],
			                pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
			                rect = thumbnail.getBoundingClientRect(); 

			            return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
			        },

			        addCaptionHTMLFn: function(item, captionEl, isFake) {
						if(!item.title) {
							captionEl.children[0].innerText = '';
							return false;
						}
						captionEl.children[0].innerHTML = item.title +  '<br/><small>Photo: ' + item.author + '</small>';
						return true;
			        },
					
			    };


			    if(fromURL) {
			    	if(options.galleryPIDs) {
			    		// parse real index when custom PIDs are used 
			    		// https://photoswipe.com/documentation/faq.html#custom-pid-in-url
			    		for(var j = 0; j < items.length; j++) {
			    			if(items[j].pid == index) {
			    				options.index = j;
			    				break;
			    			}
			    		}
				    } else {
				    	options.index = parseInt(index, 10) - 1;
				    }
			    } else {
			    	options.index = parseInt(index, 10);
			    }

			    // exit if index not found
			    if( isNaN(options.index) ) {
			    	return;
			    }



				var radios = document.getElementsByName('gallery-style');
				for (var i = 0, length = radios.length; i < length; i++) {
				    if (radios[i].checked) {
				        if(radios[i].id == 'radio-all-controls') {

				        } else if(radios[i].id == 'radio-minimal-black') {
				        	options.mainClass = 'pswp--minimal--dark';
					        options.barsSize = {top:0,bottom:0};
							options.captionEl = false;
							options.fullscreenEl = false;
							options.shareEl = false;
							options.bgOpacity = 0.85;
							options.tapToClose = true;
							options.tapToToggleControls = false;
				        }
				        break;
				    }
				}

			    if(disableAnimation) {
			        options.showAnimationDuration = 0;
			    }

			    // Pass data to PhotoSwipe and initialize it
			    gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);

			    // see: http://photoswipe.com/documentation/responsive-images.html
				var realViewportWidth,
				    useLargeImages = false,
				    firstResize = true,
				    imageSrcWillChange;

				gallery.listen('beforeResize', function() {

					var dpiRatio = window.devicePixelRatio ? window.devicePixelRatio : 1;
					dpiRatio = Math.min(dpiRatio, 2.5);
				    realViewportWidth = gallery.viewportSize.x * dpiRatio;


				    if(realViewportWidth >= 1200 || (!gallery.likelyTouchDevice && realViewportWidth > 800) || screen.width > 1200 ) {
				    	if(!useLargeImages) {
				    		useLargeImages = true;
				        	imageSrcWillChange = true;
				    	}
				        
				    } else {
				    	if(useLargeImages) {
				    		useLargeImages = false;
				        	imageSrcWillChange = true;
				    	}
				    }

				    if(imageSrcWillChange && !firstResize) {
				        gallery.invalidateCurrItems();
				    }

				    if(firstResize) {
				        firstResize = false;
				    }

				    imageSrcWillChange = false;

				});

				gallery.listen('gettingData', function(index, item) {
				    if( useLargeImages ) {
				        item.src = item.o.src;
				        item.w = item.o.w;
				        item.h = item.o.h;
				    } else {
				        item.src = item.m.src;
				        item.w = item.m.w;
				        item.h = item.m.h;
				    }
				});

			    gallery.init();
			};

			// select all gallery elements
			var galleryElements = document.querySelectorAll( gallerySelector );
			for(var i = 0, l = galleryElements.length; i < l; i++) {
				galleryElements[i].setAttribute('data-pswp-uid', i+1);
				galleryElements[i].onclick = onThumbnailsClick;
			}

			// Parse URL and open gallery if it contains #&pid=3&gid=1
			var hashData = photoswipeParseHash();
			if(hashData.pid && hashData.gid) {
				openPhotoSwipe( hashData.pid,  galleryElements[ hashData.gid - 1 ], true, true );
			}
		};

		initPhotoSwipeFromDOM('.gallery');

	})();
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
