<?php

use yii\db\Schema;
use yii\db\Migration;

class m151123_133745_create_authors_table extends Migration
{
    public function up()
    {
        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(50),
            'lastname' => $this->string(50),
        ]);
    }

    public function down()
    {
        echo "m151123_134401_create_authors_table cannot be reverted.\n";

        $this->dropTable('authors');
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
