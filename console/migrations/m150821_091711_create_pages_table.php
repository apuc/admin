<?php

use yii\db\Schema;
use yii\db\Migration;

class m150821_091711_create_pages_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('pages', [
            'id'        => Schema::TYPE_PK,
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
        $this->dropTable('pages');
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
