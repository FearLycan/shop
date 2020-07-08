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
            'image' => $this->string(),
            'description' => $this->text(),
            'link' => $this->string(),
            'status' => $this->smallInteger()->defaultValue(3),
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
