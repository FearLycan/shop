<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_image}}`.
 */
class m200723_133057_create_product_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_image}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string()->notNull(),
            'product_id' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->addForeignKey('{{%product_image_product_id_fk}}', '{{%product_image}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('{{%product_image_created_at_index}}', '{{%product}}', 'created_at');
        $this->createIndex('{{%product_image_updated_at_index}}', '{{%product}}', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_image}}');
    }
}
