<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 *
 * @property integer $tour_time_id
 * @property integer $tour_id
 * @property string $date
 */
class ToursDatesForm extends Model
{
    public $tour_id;
    public $date;

    const FIELD_TOUR_DATE_ID = 'tour_date_id';
    const FIELD_TOUR_ID = 'tour_id';
    const FIELD_DATE = 'date';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[self::FIELD_DATE], 'required'],
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

    public function save()
    {
        if (!$this->validate()) {

            return false;
        }
        $tourDate = new ToursDates;
        $tourDate->tour_id = $this->tour_id;
        $tourDate->date = $this->date;
        $tourDate->save();
        return true;
    }
}
