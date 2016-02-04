<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "tours_dates".
 *
 * @property integer $tour_date_id
 * @property integer $tour_id
 * @property string $date
 */
class ToursDates extends \yii\db\ActiveRecord
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
            [[self::FIELD_DATE], 'date', 'format' => 'Y-m-D']
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

	/**
     * @return mixed
     */
    public function getBookedPlaces($for)
    {
        $query = Bookings::find()->where([Bookings::FIELD_TOUR_DATE_ID => $this->tour_date_id]);
        return ($query->sum($for) ? $query->sum($for) : 0);
    }

    public function getAvailablePlaces($for)
    {
        $booked_places = $this->getBookedPlaces($for);
        $tour = Tours::findOne($this->tour_id);
        $all_places = 0;
        switch ($for) {
            case Bookings::FIELD_ADULTS:
                $all_places = $tour->max_adults;
                break;
            case Bookings::FIELD_CHILDREN:
                $all_places = $tour->max_children;
                break;
            case Bookings::FIELD_BABIES:
                $all_places = $tour->max_children;
                break;
        }
        $result = $all_places - $booked_places;
        return (($result >= 0 )? $result : 0);
    }

    public function getTour()
    {
        return $this->hasOne(Tours::className(), [Tours::FIELD_TOUR_ID => self::FIELD_TOUR_ID]);
    }


}
