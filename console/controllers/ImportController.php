<?php


namespace console\controllers;


use common\models\Product;
use common\models\ProductFeedback;
use common\models\ProductFeedbackImage;
use common\models\ProductImage;
use common\models\ProductSpecification;
use common\models\ProductVariant;
use common\models\Store;
use yii\console\Controller;
use yii\helpers\Url;

class ImportController extends Controller
{
    public function actionProducts()
    {
        $directory = Url::to('@app/../console/runtime/files');
        $scanned_directory = array_diff(scandir($directory), array('..', '.', '.gitignore'));

        foreach ($scanned_directory as $file) {
            echo $file . "\n";

            //FileSystem::deleteDir($directory . '/' . $dir);

            $json = file_get_contents($directory . '/' . $file);
            $data = json_decode($json, true);

            $store = $this->store($data['storeInfo']);

            $this->product($data, $store);

        }
    }

    private function store(array $data)
    {
        $store = Store::findOne([
            'company_id' => $data['companyId'],
            'store_number' => $data['storeNumber']
        ]);

        if (empty($store)) {
            $store = new Store();
            $store->status = Store::STATUS_ACTIVE;
        }

        $store->name = $data['name'];
        $store->company_id = $data['companyId'];
        $store->store_number = $data['storeNumber'];
        $store->followers = $data['followers'];
        $store->rating_count = $data['ratingCount'];
        $store->rating = $this->getPercentToNumber($data['rating']);

        $store->link = 'https://www.aliexpress.com/store/' . $store->store_number;

        $store->save();

        return $store;
    }

    private function product(array $data, Store $store)
    {
        $product = Product::findOne(['ali_product_id' => $data['productId']]);

        if (empty($product)) {
            $product = new Product();
            $product->status = Product::STATUS_TO_VERIFY;
        }

        $product->title = $data['title'];
        $product->store_id = $store->id;
        $product->ali_product_id = $data['productId'];
        $product->ali_link = 'https://www.aliexpress.com/item/' . $product->ali_product_id . '.html';
        $product->total_available_quantity = $data['totalAvailableQuantity'];
        $product->description = $data['description'];
        $product->orders = $data['orders'];
        $product->save();

        $this->productImage($data['images'], $product);
        $this->productSpecification($data['specs'], $product);

        $this->feedback($data['feedback'], $product);

        $this->productVariant($data['variants'], $product);

        return $product;
    }


    private function feedback(array $data, Product $product)
    {
        foreach ($data as $item) {

            $feedback = ProductFeedback::findOne([
                'name' => $item['name'],
                'ali_user_id' => $item['user_id'],
                'country' => $item['country'],
                'rating' => $item['rating'],
            ]);

            if (empty($feedback)) {
                $feedback = new ProductFeedback();
                $feedback->name = $item['name'];
                $feedback->display_name = $item['displayName'];
                $feedback->ali_user_id = $item['user_id'];
                $feedback->country = $item['country'];
                $feedback->rating = $item['rating'];

                if (isset($item['info']['Color:'])) {
                    $feedback->color = $item['info']['Color:'];
                }

                if (isset($item['info']['Ships From:'])) {
                    $feedback->ships_from = $item['info']['Ships From:'];
                }

                if (isset($item['info']['Logistics:'])) {
                    $feedback->ships_from = $item['info']['Logistics:'];
                }


                //$feedback->logistics = $item['info']['Logistics:'];
                $feedback->date = date('Y-m-d H:i:s', strtotime($item['date']));
                $feedback->content = $item['content'];
                $feedback->product_id = $product->id;
                $feedback->save();
            }

            $this->feedbackImage($item['photos'], $feedback);
        }
    }

    private function feedbackImage(array $images, ProductFeedback $feedback)
    {
        foreach ($images as $image) {
            $feedbackImage = ProductFeedbackImage::findOne([
                'product_feedback_id' => $feedback->id,
                'image' => $image
            ]);

            if (empty($feedbackImage)) {
                $feedbackImage = new ProductFeedbackImage();
                $feedbackImage->image = $image;
                $feedbackImage->product_feedback_id = $feedback->id;
                $feedbackImage->status = ProductFeedbackImage::STATUS_ACTIVE;
                $feedbackImage->save();
            }
        }
    }

    public function productImage(array $images, Product $product)
    {
        foreach ($images as $image) {
            $feedbackImage = ProductImage::findOne([
                'product_id' => $product->id,
                'image' => $image
            ]);

            if (empty($feedbackImage)) {
                $feedbackImage = new ProductImage();
                $feedbackImage->image = $image;
                $feedbackImage->product_id = $product->id;
                $feedbackImage->status = ProductImage::STATUS_ACTIVE;
                $feedbackImage->save();
            }
        }
    }

    public function productSpecification(array $spec, Product $product)
    {
        foreach ($spec as $item) {

            $item['attrValue'] = trim(preg_replace('/\s+/', ' ', $item['attrValue']));

            $specification = ProductSpecification::findOne([
                'name' => $item['attrName'],
                'value' => $item['attrValue'],
                'product_id' => $product->id,
            ]);

            if (empty($specification)) {
                $specification = new ProductSpecification();
                $specification->name = $item['attrName'];
                $specification->value = $item['attrValue'];
                $specification->status = ProductSpecification::STATUS_ACTIVE;
                $specification->product_id = $product->id;
                $specification->save();
            }
        }
    }

    public function productVariant(array $variants, Product $product)
    {
        if (isset($variants['prices'])) {
            foreach ($variants['prices'] as $price) {
                $options = explode(',', $price['optionValueIds']);

                foreach ($options as $option) {

                    foreach ($variants['options'] as $values) {
                        foreach ($values['values'] as $value) {
                            if ($value['id'] == $option) {

                                $variant = ProductVariant::findOne([
                                    'product_id' => $product->id,
                                    'name' => $value['name'],
                                    'display_name' => $value['displayName'],
                                ]);

                                if (empty($variant)) {
                                    $variant = new ProductVariant();
                                }

                                $variant->name = $value['name'];
                                $variant->display_name = $value['displayName'];
                                $variant->image = $value['image'];
                                $variant->product_id = $product->id;
                                $variant->original_price = $price['originalPrice'];
                                $variant->sale_price = $price['salePrice'];
                                $variant->status = ProductVariant::STATUS_ACTIVE;
                                $variant->save();

                                if ($variant->errors) {
                                    die(var_dump($variant->errors));
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    private function getPercentToNumber($percent)
    {
        if (strpos($percent, '%') !== false) {
            $percent = str_replace('%', '', $percent);
        }

        $percent = $percent * 100;

        return $percent;
    }
}
