<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tours_time".
 *
 * @property integer $tour_time_id
 * @property integer $tour_id
 * @property string $date
 */
class ToursTime extends \yii\db\ActiveRecord
{
    const FIELD_TOUR_TIME_ID = 'tour_time_id';
    const FIELD_TOUR_ID = 'tour_id';
    const FIELD_DATE = 'date';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tours_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[self::FIELD_TOUR_ID], 'integer'],
            [[self::FIELD_DATE], 'date']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tour_time_id' => 'Tour Time ID',
            'tour_id' => 'Tour ID',
            'date' => 'Date',
        ];
    }
}
