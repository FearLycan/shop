<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_variant}}`.
 */
class m200724_202359_create_product_variant_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_variant}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'display_name' => $this->string()->notNull(),
            'image' => $this->string()->null(),
            'product_id' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->createIndex('{{%product_variant_created_at_index}}', '{{%product_variant}}', 'created_at');
        $this->createIndex('{{%product_variant_updated_at_index}}', '{{%product_variant}}', 'updated_at');

        $this->addForeignKey('{{%product_variant_product_id_fk}}', '{{%product_variant}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_variant}}');
    }
}
