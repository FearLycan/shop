<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store}}`.
 */
class m200708_100227_create_store_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string(),
            'company_id' => $this->integer()->defaultValue(0),
            'store_number' => $this->integer()->defaultValue(0),
            'followers' => $this->integer()->defaultValue(0),
            'rating_count' => $this->integer()->defaultValue(0),
            'rating' => $this->integer()->defaultValue(0),
            'image' => $this->string(),
            'description' => $this->text()->null(),
            'link' => $this->string()->null(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->createIndex('{{%store_name_index}}', '{{%store}}', 'name');

        $this->createIndex('{{%store_created_at_index}}', '{{%store}}', 'created_at');
        $this->createIndex('{{%store_updated_at_index}}', '{{%store}}', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store}}');
    }
}
