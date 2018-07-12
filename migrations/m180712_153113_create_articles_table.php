<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articles`.
 */
class m180712_153113_create_articles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('articles', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'lead' => $this->text(),
            'body' => $this->text()->notNull(),
            'main_image' => $this->string(),
            'status' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()
        ]);
        
        // creates index for column `category_id`
        $this->createIndex(
            'idx-articles-category_id',
            'articles',
            'category_id'
        );

        // add foreign key for table `categories`
        $this->addForeignKey(
            'fk-articles-category_id',
            'articles',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('articles');
    }
}
