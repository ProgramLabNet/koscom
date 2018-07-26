<?php

use yii\db\Migration;

/**
 * Class m180726_144220_rename_column_sttus_from_table_slider1
 */
class m180726_144220_rename_column_sttus_from_table_slider1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('slider1', 'sttus', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180726_144220_rename_column_sttus_from_table_slider1 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180726_144220_rename_column_sttus_from_table_slider1 cannot be reverted.\n";

        return false;
    }
    */
}
