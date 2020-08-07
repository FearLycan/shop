<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product_feedback}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $slug
 * @property string|null $country
 * @property string|null $ali_user_id
 * @property int|null $rating
 * @property string|null $color
 * @property string|null $ships_from
 * @property string|null $logistics
 * @property string|null $date
 * @property string|null $content
 * @property int|null $product_id
 * @property int|null $status
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Product $product
 * @property ProductFeedbackImage[] $productFeedbackImages
 */
class ProductFeedback extends \yii\db\ActiveRecord
{
    //statuses
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

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
                'attribute' => 'display_name',
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
        return '{{%product_feedback}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['rating', 'product_id', 'status'], 'integer'],
            [['content', 'ali_user_id'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'display_name', 'slug', 'country', 'color', 'ships_from', 'logistics', 'date'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'display_name' => 'Display Name',
            'slug' => 'Slug',
            'country' => 'Country',
            'rating' => 'Rating',
            'color' => 'Color',
            'ships_from' => 'Ships From',
            'logistics' => 'Logistics',
            'date' => 'Date',
            'content' => 'Content',
            'product_id' => 'Product ID',
            'status' => 'Status',
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

    /**
     * Gets query for [[ProductFeedbackImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductFeedbackImages()
    {
        return $this->hasMany(ProductFeedbackImage::className(), ['product_feedback_id' => 'id']);
    }

    /**
     * @return string[]
     */
    public static function getStatusNames()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
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
