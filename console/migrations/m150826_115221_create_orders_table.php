<?php

use yii\db\Schema;
use yii\db\Migration;

class m150826_115221_create_orders_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('orders', [
            'id'       => Schema::TYPE_PK,
            'blind'     => Schema::TYPE_STRING . ' NOT NULL',
            'materials'   => Schema::TYPE_STRING . ' NOT NULL',
            'telephone'   => Schema::TYPE_STRING . ' NOT NULL',
            'dt_add' => Schema::TYPE_INTEGER. ' NOT NULL'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('orders');
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
