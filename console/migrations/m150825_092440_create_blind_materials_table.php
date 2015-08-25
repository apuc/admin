<?php

use yii\db\Schema;
use yii\db\Migration;

class m150825_092440_create_blind_materials_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('blind_materials', [
            'id'       => Schema::TYPE_PK,
            'id_blind'     => Schema::TYPE_INTEGER . ' NOT NULL',
            'id_materials'   => Schema::TYPE_INTEGER . ' NOT NULL',
            'title'   => Schema::TYPE_STRING . ' NOT NULL'
        ], $tableOptions);
    }


    public function down()
    {
        $this->dropTable('blind_materials');
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
