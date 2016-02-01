<?php
	/**
	 * Created by PhpStorm.
	 * User: andreyshade
	 * Date: 01.02.16
	 * Time: 13:59
	 */

	namespace app\models;


	use yii\base\Model;

	class TourForm extends Model
	{

		public $tour_id;
		public $title;
		public $max_adults;
		public $max_children;
		public $max_babies;

		const FIELD_TITLE = 'title';
		const FIELD_MAX_ADULTS = 'max_adults';
		const FIELD_MAX_CHILDREN = 'max_children';
		const FIELD_MAX_BABIES = 'max_babies';

		public function rules()
		{
			return [
				[[self::FIELD_TITLE, self::FIELD_MAX_ADULTS, self::FIELD_MAX_CHILDREN, self::FIELD_MAX_BABIES], 'required'],
				[[self::FIELD_TITLE], 'string', 'max' => 255],
				[[self::FIELD_MAX_ADULTS, self::FIELD_MAX_CHILDREN, self::FIELD_MAX_BABIES], 'integer', 'min' => 0],
			];
		}

		public function attributeLabels()
		{
			return [
				self::FIELD_TITLE => 'Title',
				self::FIELD_MAX_ADULTS => 'Max Adults',
				self::FIELD_MAX_CHILDREN => 'Max Children',
				self::FIELD_MAX_BABIES => 'Max Babies'
			];
		}

		/**
		 * @param $tour Tours
		 */
		public function initForm($tour)
		{
			$this->tour_id = $tour->tour_id;
			$this->title = $tour->title;
			$this->max_adults = $tour->max_adults;
			$this->max_children = $tour->max_children;
			$this->max_babies = $tour->max_babies;
		}

		public function save()
		{
			if (!$this->validate()) {
				return false;
			}

			$tour = ($this->tour_id ? Tours::findOne($this->tour_id) : new Tours());
			$tour->title = $this->title;
			$tour->max_adults = $this->max_adults;
			$tour->max_children = $this->max_children;
			$tour->max_babies = $this->max_babies;
			$tour->save();

			return true;
		}

	}