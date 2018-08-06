<?php

use yii\db\Migration;

/**
 * Class m180803_110743_alter_column_url_from_table_categories
 */
class m180803_110743_alter_column_url_from_table_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('categories', 'url',  $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180803_110743_alter_column_url_from_table_categories cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180803_110743_alter_column_url_from_table_categories cannot be reverted.\n";

        return false;
    }
    */
}
