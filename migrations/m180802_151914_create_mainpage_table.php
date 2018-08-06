<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mainpage`.
 */
class m180802_151914_create_mainpage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('mainpage', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'article_link' => $this->string()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('mainpage');
    }
}
