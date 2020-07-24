<?php

use yii\db\Migration;


/**
 * Handles the creation of table `{{%product}}`.
 */
class m200723_130329_create_product_table extends Migration
{

    use common\components\traits\TextTypesTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->null(),
            'store_id' => $this->integer()->null(),
            'product_id' => $this->integer()->null(),
            'category_id' => $this->integer()->null(),
            'ali_product_id' => $this->integer()->defaultValue(0),
            'ali_link' => $this->string()->notNull(),
            'ref' => $this->string()->null(),
            'total_available_quantity' => $this->integer()->defaultValue(0),
            'description' => $this->longText()->null(),
            'orders' => $this->integer()->defaultValue(0),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->addForeignKey('{{%product_store_id_fk}}', '{{%product}}', 'store_id', '{{%store}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%product_category_id_fk}}', '{{%product}}', 'category_id', '{{%store}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('{{%product_name_index}}', '{{%product}}', 'title');
        $this->createIndex('{{%product_slug_index}}', '{{%product}}', 'slug');

        $this->createIndex('{{%product_created_at_index}}', '{{%product}}', 'created_at');
        $this->createIndex('{{%product_updated_at_index}}', '{{%product}}', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
