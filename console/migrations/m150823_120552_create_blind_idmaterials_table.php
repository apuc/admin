<?php

use yii\db\Schema;
use yii\db\Migration;

class m150823_120552_create_blind_idmaterials_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('blind_idmaterials', [
            'id'       => Schema::TYPE_PK,
            'id_blind'     => Schema::TYPE_INTEGER . ' NOT NULL',
            'id_materials'   => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('blind_idmaterials');
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
