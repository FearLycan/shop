<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property string $title
 * @property string|null $slug
 * @property int|null $store_id
 * @property int|null $category_id
 * @property int|null $ali_product_id
 * @property string $ali_link
 * @property string|null $ref
 * @property int|null $total_available_quantity
 * @property string|null $description
 * @property int|null $orders
 * @property int|null $status
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Store $category
 * @property Store $store
 * @property ProductFeedback[] $feedbacks
 * @property ProductImage[] $images
 * @property ProductSpecification[] $specifications
 * @property ProductVariant[] $variants
 */
class Product extends \yii\db\ActiveRecord
{
    //statuses
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_TO_VERIFY = 3;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date("Y-m-d H:i:s"),
            ],
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
                'immutable' => true,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'ali_link'], 'required'],
            [['store_id', 'category_id', 'ali_product_id', 'total_available_quantity', 'orders', 'status'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug', 'ali_link', 'ref'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'store_id' => 'Store ID',
            'category_id' => 'Category ID',
            'ali_product_id' => 'Ali Product ID',
            'ali_link' => 'Ali Link',
            'ref' => 'Ref',
            'total_available_quantity' => 'Total Available Quantity',
            'description' => 'Description',
            'orders' => 'Orders',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Store::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Store]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }

    /**
     * Gets query for [[ProductFeedbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(ProductFeedback::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductSpecifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecifications()
    {
        return $this->hasMany(ProductSpecification::className(), ['product_id' => 'id']);
    }

    public function getSpecificationsHalf($halt = 1)
    {
        $len = count($this->specifications);

        if ($halt == 1) {
            return array_slice($this->specifications, 0, $len / 2);
        } else {
            return array_slice($this->specifications, $len / 2);
        }


        //$firsthalf = array_slice($input, 0, $len / 2);
        //$secondhalf = array_slice($input, $len / 2);
    }

    /**
     * Gets query for [[ProductVariants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVariants()
    {
        return $this->hasMany(ProductVariant::className(), ['product_id' => 'id']);
    }

    /**
     * @return string[]
     */
    public static function getStatusNames()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_TO_VERIFY => 'To verify',
        ];
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return self::getStatusNames()[$this->status];
    }
}
