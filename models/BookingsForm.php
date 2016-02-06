<?php

namespace app\models;

use yii\base\Model;

/**
 *
 */
class BookingsForm extends Model
{
    public $tour;
    public $tour_date_id;
    public $name;
    public $adults;
    public $children;
    public $babies;
    public $custom_fields = [];



    const FIELD_BOOKING_ID = 'booking_id';
    const FIELD_TOUR_DATE_ID = 'tour_date_id';
    const FIELD_NAME = 'name';
    const FIELD_ADULTS = 'adults';
    const FIELD_CHILDREN = 'children';
    const FIELD_BABIES = 'babies';
    const FiELD_CUSTOM_FIELDS = 'custom_fields';

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
            [[self::FIELD_NAME], 'required'],
            [[self::FIELD_TOUR_DATE_ID, self::FIELD_ADULTS, self::FIELD_CHILDREN, self::FIELD_BABIES], 'integer'],
            [[self::FIELD_ADULTS, self::FIELD_CHILDREN, self::FIELD_BABIES], 'validateMaxAvailable'],
            [[self::FIELD_NAME], 'string', 'max' => 255],
            [[self::FiELD_CUSTOM_FIELDS], 'safe']
        ];
    }
    
    public function validateMaxAvailable($attribute, $params)
    {

        $tour_date = ToursDates::findOne($this->tour_date_id);
        if ($this->$attribute > $tour_date->getAvailablePlaces($attribute)) {

            $this->addError($attribute, 'Max available places for this field is ' . $tour_date->getAvailablePlaces($attribute));
        }

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
    
    public function save()
    {
        if (!$this->validate()) {
             return false;      
        }
        if (($this->adults + $this->children +$this->babies) == 0) {
            \Yii::$app->session->setFlash('danger', 'Error! You must book at least one place');
            return false;
        }
        $booking = new Bookings();
        $booking->attributes = $this->attributes;
        $booking->custom_fields = serialize($this->custom_fields);
        $booking->save();
        return true;            
    }
}
