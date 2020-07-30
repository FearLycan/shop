<?php


namespace console\controllers;


use common\models\Product;
use common\models\ProductFeedback;
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
            //FileSystem::deleteDir($directory . '/' . $dir);

            $json = file_get_contents($directory . '/' . $file);
            $data = json_decode($json, true);

            $store = $this->store($data['storeInfo']);
            $product = $this->product($data, $store);
            $this->feedback($data['feedback'], $product);


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

        return $product;
    }


    private function feedback(array $data, Product $product)
    {
        foreach ($data as $item) {

            $feedback = ProductFeedback::findOne([
                'name' => $item['name'],
                'display_name' => $item['displayName'],
                'country' => $item['country'],
                'rating' => $item['rating'],
            ]);

            if (empty($feedback)) {
                $feedback = new ProductFeedback();
                $feedback->name = $item['name'];
                $feedback->display_name = $item['displayName'];
                $feedback->country = $item['country'];
                $feedback->rating = $item['rating'];
                $feedback->color = $item['info']['Color:'];
                $feedback->ships_from = $item['info']['Ships From:'];
                $feedback->logistics = $item['info']['Logistics:'];
                $feedback->date = date('Y-m-d H:i:s', strtotime($item['date']));
                $feedback->content = $item['content'];
                $feedback->product_id = $product->id;
                $feedback->save();

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
