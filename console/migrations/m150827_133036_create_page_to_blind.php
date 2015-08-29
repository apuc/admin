<?php

use yii\db\Schema;
use yii\db\Migration;

class m150827_133036_create_page_to_blind extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('page_to_blind', [
            'id'       => Schema::TYPE_PK,
            'id_blind'     => Schema::TYPE_INTEGER . ' NOT NULL',
            'id_pages'   => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('page_to_blind');
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
