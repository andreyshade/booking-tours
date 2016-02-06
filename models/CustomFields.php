<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "custom_fields".
 *
 * @property integer $custom_field_id
 * @property integer $tour_id
 * @property string $label
 */
class CustomFields extends \yii\db\ActiveRecord
{
    const FIELD_CUSTOM_FIELD_ID = 'custom_field_id';
    const FIELD_TOUR_ID = 'tour_id';
    const FIELD_LABEL = 'label';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'custom_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[self::FIELD_TOUR_ID], 'integer'],
            [[self::FIELD_LABEL], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            self::FIELD_CUSTOM_FIELD_ID => 'Custom Field ID',
            self::FIELD_TOUR_ID => 'Tour ID',
            self::FIELD_LABEL => 'Label',
        ];
    }

    public static function getCustomFieldsArray($tour_id)
    {
        $query = new Query;
        $query->from(CustomFields::tableName())->where([CustomFields::FIELD_TOUR_ID => $tour_id]);
        $result = $query->all();
        return $result;
    }
}
