<?php

namespace backend\modules\admin\models\forms;

use backend\models\Product;
use common\models\Store;

class ProductForm extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'ali_link', 'category_id', 'store_id', 'status'], 'required'],
            [['store_id', 'category_id', 'ali_product_id', 'total_available_quantity', 'orders', 'status'], 'integer'],
            [['description'], 'string'],
            [['title', 'slug', 'ali_link', 'ref'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_id' => 'id']],
        ];
    }
}
