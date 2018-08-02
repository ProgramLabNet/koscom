<?php

use yii\db\Migration;

/**
 * Class m180801_095933_add_column_alias_to_articles_table
 */
class m180801_095933_add_column_alias_to_articles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('articles', 'alias', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180801_095933_add_column_alias_to_articles_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180801_095933_add_column_alias_to_articles_table cannot be reverted.\n";

        return false;
    }
    */
}
