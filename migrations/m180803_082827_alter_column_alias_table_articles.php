<?php

use yii\db\Migration;

/**
 * Class m180803_082827_alter_column_alias_table_articles
 */
class m180803_082827_alter_column_alias_table_articles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('articles', 'alias', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180803_082827_alter_column_alias_table_articles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180803_082827_alter_column_alias_table_articles cannot be reverted.\n";

        return false;
    }
    */
}
