<?php

use yii\db\Schema;
use yii\db\Migration;

class m150822_101933_create_options_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('options', [
            'id'       => Schema::TYPE_PK,
            'name'     => Schema::TYPE_STRING . ' NOT NULL',
            'key'      => Schema::TYPE_STRING . ' NOT NULL',
            'value'    => Schema::TYPE_STRING . ' NOT NULL',

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('options');
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
