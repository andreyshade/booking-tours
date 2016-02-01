<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tours_dates".
 *
 * @property integer $tour_time_id
 * @property integer $tour_id
 * @property string $date
 */
class ToursTime extends \yii\db\ActiveRecord
{
    const FIELD_TOUR_DATE_ID = 'tour_date_id';
    const FIELD_TOUR_ID = 'tour_id';
    const FIELD_DATE = 'date';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tours_dates';
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
            self::FIELD_TOUR_DATE_ID => 'Tour Date ID',
            self::FIELD_TOUR_ID => 'Tour ID',
            self::FIELD_DATE => 'Date',
        ];
    }
}
