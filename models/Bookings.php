<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bookings".
 *
 * @property integer $booking_id
 * @property integer $tour_id
 * @property string $date
 * @property string $name
 * @property integer $adults
 * @property integer $children
 * @property integer $babies
 */
class Bookings extends \yii\db\ActiveRecord
{
    const FIELD_BOOKING_ID = 'booking_id';
    const FIELD_TOUR_ID = 'tour_id';
    const FIELD_DATE = 'date';
    const FIELD_NAME = 'name';
    const FIELD_ADULTS = 'adults';
    const FIELD_CHILDREN = 'children';
    const FIELD_BABIES = 'babies';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bookings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[self::FIELD_TOUR_ID, self::FIELD_ADULTS, self::FIELD_CHILDREN, self::FIELD_BABIES], 'integer'],
            [[self::FIELD_DATE], 'safe'],
            [[self::FIELD_NAME], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            self::FIELD_BOOKING_ID => 'Booking ID',
            self::FIELD_TOUR_ID => 'Tour ID',
            self::FIELD_DATE => 'Date',
            self::FIELD_NAME => 'Name',
            self::FIELD_ADULTS => 'Adults',
            self::FIELD_CHILDREN => 'Children',
            self::FIELD_BABIES => 'Babies',
        ];
    }
}
