<?php

use yii\db\Schema;
use yii\db\Migration;

class m150829_065828_create_page_for_title_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('page_for_title', [
            'id'       => Schema::TYPE_PK,
            'title'     => Schema::TYPE_STRING . ' NOT NULL'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('page_for_title');
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
