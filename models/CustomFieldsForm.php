<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 *
 * @property integer $custom_field_id
 * @property integer $tour_id
 * @property string $label
 */
class CustomFieldsForm extends Model
{
    public $custom_field_id;
    public $tour_id;
    public $label;

    const FIELD_CUSTOM_FIELD_ID = 'custom_field_id';
    const FIELD_TOUR_ID = 'tour_id';
    const FIELD_LABEL = 'label';

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
    
    public function save()
    {
        if (!$this->validate()) {

            return false;
        }

        $customField = new CustomFields();
        $customField->attributes = $this->attributes;
        $customField->save();
        return true;
    }
}
