<?php

use yii\db\Migration;

/**
 * Class m180717_094741_add_column_preview_image_to_articles_table
 */
class m180717_094741_add_column_preview_image_to_articles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('articles', 'preview_image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180717_094741_add_column_preview_image_to_articles_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180717_094741_add_column_preview_image_to_articles_table cannot be reverted.\n";

        return false;
    }
    */
}
