<?php

use yii\db\Migration;

/**
 * Handles adding url to table `categories`.
 */
class m180711_152711_add_url_column_to_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('categories', 'url', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
