<?php

use yii\db\Schema;
use yii\db\Migration;

class m150827_090837_blind_img_add_column_main extends Migration
{
    public function up()
    {
        $this->addColumn('blind_img', 'main', Schema::TYPE_INTEGER);
    }

    public function down()
    {
        $this->dropColumn('blind_img', 'main');
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
