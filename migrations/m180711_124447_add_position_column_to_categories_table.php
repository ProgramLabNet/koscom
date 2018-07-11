<?php

use yii\db\Migration;

/**
 * Handles adding position to table `categories`.
 */
class m180711_124447_add_position_column_to_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('categories', 'position', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
