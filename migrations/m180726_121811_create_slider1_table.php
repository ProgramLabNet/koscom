<?php

use yii\db\Migration;

/**
 * Handles the creation of table `slider1`.
 */
class m180726_121811_create_slider1_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('slider1', [
            'id' => $this->primaryKey(),
            'image' => $this->string()->notNull(),
            'link' => $this->string()->notNull(),
            'sttus' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('slider1');
    }
}
