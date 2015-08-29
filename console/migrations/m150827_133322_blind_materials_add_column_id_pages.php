<?php

use yii\db\Schema;
use yii\db\Migration;

class m150827_133322_blind_materials_add_column_id_pages extends Migration
{
    public function up()
    {
        $this->addColumn('blind_idmaterials', 'id_pages', Schema::TYPE_INTEGER);
    }

    public function down()
    {
        $this->dropColumn('blind_idmaterials', 'id_pages');
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
