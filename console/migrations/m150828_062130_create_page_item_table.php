<?php

use yii\db\Schema;
use yii\db\Migration;

class m150828_062130_create_page_item_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('page_item', [
            'id'       => Schema::TYPE_PK,
            'id_page'     => Schema::TYPE_INTEGER . ' NOT NULL',
            'id_item'   => Schema::TYPE_INTEGER . ' NOT NULL',
            'item_type'   => Schema::TYPE_STRING . ' NOT NULL',
            'id_blind'   => Schema::TYPE_INTEGER . ' NOT NULL'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('page_item');
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
