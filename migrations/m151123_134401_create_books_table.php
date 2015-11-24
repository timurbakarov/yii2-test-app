<?php

use yii\db\Schema;
use yii\db\Migration;

class m151123_134401_create_books_table extends Migration
{
    public function up()
    {
        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'date_create' => $this->timestamp(),
            'date_update' => $this->timestamp(),
            'preview' => $this->string(),
            'date' => $this->date(),
            'author_id' => $this->integer(),
        ]);

        $this->addForeignKey('author_id', 'books', 'author_id', 'authors', 'id', 'RESTRICT');
    }

    public function down()
    {
        echo "m151123_133745_create_books_table cannot be reverted.\n";

        $this->dropTable('books');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
