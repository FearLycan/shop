<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_specyfication}}`.
 */
class m200724_204904_create_product_specification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_specification}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'value' => $this->string()->notNull(),
            'product_id' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
        ]);

        $this->createIndex('{{%product_specification_name_index}}', '{{%product_specification}}', 'name');
        $this->createIndex('{{%product_specification_value_index}}', '{{%product_specification}}', 'value');

        $this->createIndex('{{%product_specification_created_at_index}}', '{{%product_specification}}', 'created_at');
        $this->createIndex('{{%product_specification_updated_at_index}}', '{{%product_specification}}', 'updated_at');

        $this->addForeignKey('{{%product_specification_product_id_fk}}', '{{%product_specification}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_specyfication}}');
    }
}
