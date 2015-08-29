<?php

use yii\db\Schema;
use yii\db\Migration;

class m150827_133130_create_page_blinds_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('page_blinds', [
            'id'       => Schema::TYPE_PK,
            'name'     => Schema::TYPE_STRING . ' NOT NULL'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('page_blinds');
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
