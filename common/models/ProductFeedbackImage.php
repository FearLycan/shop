<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_feedback_image}}".
 *
 * @property int $id
 * @property string $image
 * @property int|null $product_feedback_id
 * @property int|null $status
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property ProductFeedback $productFeedback
 */
class ProductFeedbackImage extends \yii\db\ActiveRecord
{
    //statuses
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_feedback_image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image'], 'required'],
            [['product_feedback_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['image'], 'string', 'max' => 255],
            [['product_feedback_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductFeedback::className(), 'targetAttribute' => ['product_feedback_id' => 'id']],
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
            'product_feedback_id' => 'Product Feedback ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[ProductFeedback]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductFeedback()
    {
        return $this->hasOne(ProductFeedback::className(), ['id' => 'product_feedback_id']);
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
