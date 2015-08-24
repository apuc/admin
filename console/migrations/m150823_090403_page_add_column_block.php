<?php

use yii\db\Schema;
use yii\db\Migration;

class m150823_090403_page_add_column_block extends Migration
{
    public function up()
    {
        $this->addColumn('pages', 'code', Schema::TYPE_TEXT);
        $this->addColumn('pages', 'style', Schema::TYPE_TEXT);

        $this->addColumn('categories', 'code', Schema::TYPE_TEXT);
        $this->addColumn('categories', 'style', Schema::TYPE_TEXT);
    }

    public function down()
    {
        $this->dropColumn('pages', 'code');
        $this->dropColumn('pages', 'style');

        $this->dropColumn('categories', 'code');
        $this->dropColumn('categories', 'style');
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
