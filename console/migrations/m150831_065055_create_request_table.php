<?php

use yii\db\Schema;
use yii\db\Migration;

class m150831_065055_create_request_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('request', [
            'id'       => Schema::TYPE_PK,
            'telephone'   => Schema::TYPE_STRING . ' NOT NULL',
            'dt_add' => Schema::TYPE_INTEGER. ' NOT NULL'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('request');
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
