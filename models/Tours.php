<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tours".
 *
 * @property integer $tour_id
 * @property string $title
 * @property integer $max_adults
 * @property integer $max_children
 * @property integer $max_babies
 * @property string $tours_dates
 */
class Tours extends \yii\db\ActiveRecord
{
    const FIELD_TOUR_ID = 'tour_id';
    const FIELD_TITLE = 'title';
    const FIELD_MAX_ADULTS = 'max_adults';
    const FIELD_MAX_CHILDREN = 'max_children';
    const FIELD_MAX_BABIES = 'max_babies';
    const FIELD_TOURS_DATES = 'tours_dates';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[self::FIELD_MAX_ADULTS, self::FIELD_MAX_CHILDREN, self::FIELD_MAX_BABIES], 'integer'],
            [[self::FIELD_TITLE, self::FIELD_TOURS_DATES], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            self::FIELD_TOUR_ID => 'Tour ID',
            self::FIELD_TITLE => 'Title',
            self::FIELD_MAX_ADULTS => 'Max Adults',
            self::FIELD_MAX_CHILDREN => 'Max Children',
            self::FIELD_MAX_BABIES => 'Max Babies',
            self::FIELD_TOURS_DATES => 'Tours Dates',
        ];
    }
}
