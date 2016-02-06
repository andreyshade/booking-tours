<?php

use yii\db\Schema;
use yii\db\Migration;

class m160206_154905_create_custom_fields_table extends Migration
{
    public function up()
    {
        $this->createTable('custom_fields',[
            'custom_field_id' => Schema::TYPE_PK,
            'tour_id' => Schema::TYPE_INTEGER,
            'label' => Schema::TYPE_STRING
        ]);
    }

    public function down()
    {
        $this->dropTable('custom_fields');
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
