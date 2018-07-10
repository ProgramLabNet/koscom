<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories`.
 */
class m180710_093448_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'parent_id' => $this->integer()->notNull(),
            'level' => $this->integer()->defaultValue(1)->notNull(),
            'status' => $this->integer()->defaultValue(1)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categories');
    }
}
