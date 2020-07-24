<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feedback_image}}`.
 */
class m200723_135637_create_feedback_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_feedback_image}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string()->notNull(),
            'product_feedback_id' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->addForeignKey('{{%product_feedback_image_product_id_fk}}', '{{%product_feedback_image}}', 'product_feedback_id', '{{%product_feedback}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('{{%product_feedback_created_at_index}}', '{{%product_feedback_image}}', 'created_at');
        $this->createIndex('{{%product_feedback_updated_at_index}}', '{{%product_feedback_image}}', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feedback_image}}');
    }
}
