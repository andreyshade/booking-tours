<?php

use yii\db\Schema;
use yii\db\Migration;

class m160121_211109_create_bookings_table extends Migration
{
    public function up()
    {
        $this->createTable('bookings', [
            'booking_id' => Schema::TYPE_PK,
            'tour_id' => Schema::TYPE_INTEGER,
            'date' => Schema::TYPE_DATE,
            'name' => Schema::TYPE_STRING,
            'adults' => Schema::TYPE_INTEGER,
            'children' => Schema::TYPE_INTEGER,
            'babies' =>Schema::TYPE_INTEGER
        ]);
    }

    public function down()
    {
        $this->dropTable('bookings');
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
