<?php

use yii\db\Migration;

/**
 * Class m180803_082201_delete_column_from_mainpage_table
 */
class m180803_082201_delete_column_from_mainpage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('mainpage', 'article_link');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180803_082201_delete_column_from_mainpage_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180803_082201_delete_column_from_mainpage_table cannot be reverted.\n";

        return false;
    }
    */
}
