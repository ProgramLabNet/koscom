<?php

use yii\db\Migration;

/**
 * Class m180727_075942_alter_column_title_to_slider1_table
 */
class m180727_075942_alter_column_title_to_slider1_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('slider1', 'title', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180727_075942_alter_column_title_to_slider1_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180727_075942_alter_column_title_to_slider1_table cannot be reverted.\n";

        return false;
    }
    */
}
