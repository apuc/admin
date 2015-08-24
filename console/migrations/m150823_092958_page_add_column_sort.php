<?php

use yii\db\Schema;
use yii\db\Migration;

class m150823_092958_page_add_column_sort extends Migration
{
    public function up()
    {
        $this->addColumn('pages', 'sort', Schema::TYPE_STRING);
        $this->addColumn('categories', 'sort', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('categories', 'sort');
        $this->dropColumn('pages', 'sort');
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
