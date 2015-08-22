<?php

use yii\db\Schema;
use yii\db\Migration;

class m150822_114929_create_supplies_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('supplies', [
            'id'       => Schema::TYPE_PK,
            'images'     => Schema::TYPE_STRING . ' NOT NULL',
            'code'   => Schema::TYPE_INTEGER . ' NOT NULL',
            'type_mat'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'type_blind'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'type_width'    => Schema::TYPE_STRING . ' NOT NULL',
            'color'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'price'    => Schema::TYPE_STRING . ' NOT NULL',
            'status'    => Schema::TYPE_INTEGER . ' NOT NULL',

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('supplies');
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
