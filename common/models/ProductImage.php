<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_image}}".
 *
 * @property int $id
 * @property string $image
 * @property int|null $product_id
 * @property int|null $status
 * @property float|null $original_price
 * @property float|null $sale_price
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Product $product
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image'], 'required'],
            [['product_id', 'status'], 'integer'],
            [['original_price', 'sale_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['image'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'product_id' => 'Product ID',
            'status' => 'Status',
            'original_price' => 'Original Price',
            'sale_price' => 'Sale Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
