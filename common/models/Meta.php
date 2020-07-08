<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%meta}}".
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property int|null $status
 * @property string|null $type
 * @property int|null $model_id
 * @property string $created_at
 * @property string|null $updated_at
 */
class Meta extends \yii\db\ActiveRecord
{
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%meta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'required'],
            [['status', 'model_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'content', 'type'], 'string', 'max' => 255],
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
            'content' => 'Content',
            'status' => 'Status',
            'type' => 'Type',
            'model_id' => 'Model ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
