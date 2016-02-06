<?php
	/**
	 * Created by PhpStorm.
	 * User: andreyshade
	 * Date: 05.02.16
	 * Time: 13:40
	 *
	 * @var $model \app\models\ToursDates;
	 *
	 */
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\models\Bookings;
use app\models\CustomFields;
?>
<div class="col-sm-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?= Html::tag('h4', $model->date)?>
		</div>
		<div class="panel-body">
			<h5 >Booked places</h5>
			<?= GridView::widget([
				'dataProvider' => new ActiveDataProvider(['query' => Bookings::find()->where([Bookings::FIELD_TOUR_DATE_ID => $model->tour_date_id])]),
				'columns' => [
					Bookings::FIELD_NAME,
					Bookings::FIELD_ADULTS,
					Bookings::FIELD_CHILDREN,
					Bookings::FIELD_BABIES,
					[
						'class' => DataColumn::className(),
						'format' => 'html',
						'attribute' => Bookings::FIELD_CUSTOM_FIELDS,
						'value' => function($model){
							/* @var $model Bookings */
							$result = 'Not set';
							if (isset($model->custom_fields)) {
								$result = null;
								$custom_fields = unserialize($model->custom_fields);
								foreach ($custom_fields as $key => $value) {
									$custom_field = CustomFields::findOne($key);
									$result .= '<b>' . $custom_field->label . ': </b>' . $value . '<br>';
								}
							}

							return $result;
						}
					]
				],
			]) ?>
		</div>
	</div>
</div>
