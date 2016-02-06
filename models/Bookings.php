<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bookings".
 *
 * @property integer $booking_id
 * @property integer $tour_date_id
 * @property string $name
 * @property integer $adults
 * @property integer $children
 * @property integer $babies
 * @property string $custom_fields
 */
class Bookings extends \yii\db\ActiveRecord
{
    const FIELD_BOOKING_ID = 'booking_id';
    const FIELD_TOUR_DATE_ID = 'tour_date_id';
    const FIELD_NAME = 'name';
    const FIELD_ADULTS = 'adults';
    const FIELD_CHILDREN = 'children';
    const FIELD_BABIES = 'babies';
    const FIELD_CUSTOM_FIELDS = 'custom_fields';

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
            [[self::FIELD_TOUR_DATE_ID, self::FIELD_ADULTS, self::FIELD_CHILDREN, self::FIELD_BABIES], 'integer'],
            [[self::FIELD_NAME], 'string', 'max' => 255],
            [[self::FIELD_CUSTOM_FIELDS], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            self::FIELD_BOOKING_ID => 'Booking ID',
            self::FIELD_TOUR_DATE_ID => 'Tour Date ID',
            self::FIELD_NAME => 'Name',
            self::FIELD_ADULTS => 'Adults',
            self::FIELD_CHILDREN => 'Children',
            self::FIELD_BABIES => 'Babies',
        ];
    }

    public function getTourDate()
    {
        return $this->hasOne(ToursDates::className(), [ToursDates::FIELD_TOUR_DATE_ID => self::FIELD_TOUR_DATE_ID]);
    }
}
