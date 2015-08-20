<?php

use yii\db\Schema;
use yii\db\Migration;

class m150820_081335_create_categories_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('categories', [
            'id'        => Schema::TYPE_PK,
            'parent_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name'      => Schema::TYPE_STRING . ' NOT NULL',
            'images'    => Schema::TYPE_STRING . ' NOT NULL',
            'count_product'=> Schema::TYPE_INTEGER. ' NOT NULL',
            'hint'      => Schema::TYPE_STRING . ' NOT NULL',
            'description'=> Schema::TYPE_TEXT . ' NOT NULL',
            'title'     => Schema::TYPE_STRING . ' NOT NULL',
            'h1'        => Schema::TYPE_STRING . ' NOT NULL',
            'keywords'  => Schema::TYPE_STRING . ' NOT NULL',
            'blokc_id'  => Schema::TYPE_INTEGER. ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('categories');
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
