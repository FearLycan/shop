<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_price}}`.
 */
class m200724_210343_create_product_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_price}}', [
            'id' => $this->primaryKey(),
            'original_price_max' => $this->decimal(4, 2)->null()->defaultValue(0),
            'original_price_min' => $this->decimal(4, 2)->null()->defaultValue(0),
            'sale_price_min' => $this->decimal(4, 2)->null()->defaultValue(0),
            'sale_price_max' => $this->decimal(4, 2)->null()->defaultValue(0),
            'product_id' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);


        $this->addForeignKey('{{%product_price_product_id_fk}}', '{{%product_price}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('{{%product_price_created_at_index}}', '{{%product}}', 'created_at');
        $this->createIndex('{{%product_price_updated_at_index}}', '{{%product}}', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_price}}');
    }
}
