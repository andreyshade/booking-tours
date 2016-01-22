<?php

use yii\db\Schema;
use yii\db\Migration;

class m160121_202600_create_tours_table extends Migration
{
    public function up()
    {
        $this->createTable('tours', [
            'tour_id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING,
            'max_adults' => Schema::TYPE_INTEGER,
            'max_children' => Schema::TYPE_INTEGER,
            'max_babies' => Schema::TYPE_INTEGER,
            'tours_dates' => Schema::TYPE_STRING
        ]);
    }

    public function down()
    {
       $this->dropTable('tours');
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
