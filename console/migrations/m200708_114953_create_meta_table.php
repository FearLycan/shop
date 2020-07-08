<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%meta}}`.
 */
class m200708_114953_create_meta_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%meta}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'content' => $this->string()->notNull(),
            'status' => $this->smallInteger()->defaultValue(1),
            'type' => $this->string(),
            'model_id' => $this->integer(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()
        ]);

        $this->createIndex('{{%meta_name_index}}', '{{%meta}}', 'name');

        $this->createIndex('{{%meta_created_at_index}}', '{{%meta}}', 'created_at');
        $this->createIndex('{{%meta_updated_at_index}}', '{{%meta}}', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%meta}}');
    }
}
