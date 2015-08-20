<?php

use yii\db\Schema;
use yii\db\Migration;

class m150818_091143_create_menu_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('menu', [
            'id'         => Schema::TYPE_PK,
            'parent_id'      => Schema::TYPE_INTEGER . ' NOT NULL',
            'name'      => Schema::TYPE_STRING . ' NOT NULL',
            'url'      => Schema::TYPE_STRING . ' NOT NULL',
            'icon'      => Schema::TYPE_STRING . ' NOT NULL',
            'descr'      => Schema::TYPE_TEXT . ' NOT NULL',
            'sort'      => Schema::TYPE_INTEGER,

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('menu');
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
