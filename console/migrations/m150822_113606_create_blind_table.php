<?php

use yii\db\Schema;
use yii\db\Migration;

class m150822_113606_create_blind_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('blind', [
            'id'       => Schema::TYPE_PK,
            'name'     => Schema::TYPE_STRING . ' NOT NULL',
            'status'   => Schema::TYPE_INTEGER . ' NOT NULL',
            'description'    => Schema::TYPE_TEXT . ' NOT NULL',

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('blind');
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
