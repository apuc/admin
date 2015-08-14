<?php

use yii\db\Schema;
use yii\db\Migration;

class m150814_090331_create_block_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('block', [
            'id'         => Schema::TYPE_PK,
            'key'      => Schema::TYPE_STRING . ' NOT NULL',
            'name'      => Schema::TYPE_STRING . ' NOT NULL',
            'code'      => Schema::TYPE_TEXT . ' NOT NULL',
            'style'      => Schema::TYPE_TEXT,
            'img'      => Schema::TYPE_STRING,
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('block');
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
