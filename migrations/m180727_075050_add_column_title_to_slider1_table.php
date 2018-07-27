<?php

use yii\db\Migration;

/**
 * Class m180727_075050_add_column_title_to_slider1_table
 */
class m180727_075050_add_column_title_to_slider1_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('slider1', 'title', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180727_075050_add_column_title_to_slider1_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180727_075050_add_column_title_to_slider1_table cannot be reverted.\n";

        return false;
    }
    */
}
