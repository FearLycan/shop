<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feedback}}`.
 */
class m200723_133809_create_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_feedback}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'display_name' => $this->string()->null(),
            'slug' => $this->string()->null(),
            'country' => $this->string()->null(),
            'rating' => $this->integer()->defaultValue(0),
            'color' => $this->string()->null(),
            'ships_from' => $this->string()->null(),
            'logistics' => $this->string()->null(),
            'date' => $this->string()->null(),
            'content' => $this->text()->null(),
            'product_id' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->createIndex('{{%product_feedback_created_at_index}}', '{{%product_feedback}}', 'created_at');
        $this->createIndex('{{%product_feedback_updated_at_index}}', '{{%product_feedback}}', 'updated_at');

        $this->addForeignKey('{{%product_feedback_product_id_fk}}', '{{%product_feedback}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feedback}}');
    }
}
