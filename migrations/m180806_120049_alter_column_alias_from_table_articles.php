<?php

use yii\db\Migration;

/**
 * Class m180806_120049_alter_column_alias_from_table_articles
 */
class m180806_120049_alter_column_alias_from_table_articles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('articles', 'alias', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180806_120049_alter_column_alias_from_table_articles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180806_120049_alter_column_alias_from_table_articles cannot be reverted.\n";

        return false;
    }
    */
}
