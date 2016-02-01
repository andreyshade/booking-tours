<?php

use yii\db\Schema;
use yii\db\Migration;

class m160201_112127_create_tours_dates_table extends Migration
{
    public function up()
    {
        $this->createTable('tours_dates', [
            'tour_date_id' => Schema::TYPE_PK,
            'tour_id' => Schema::TYPE_INTEGER,
            'date' => Schema::TYPE_DATE
        ]);
    }

    public function down()
    {
        $this->dropTable('tours_dates');
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
