<?php
	/**
	 * Created by PhpStorm.
	 * User: andreyshade
	 * Date: 05.02.16
	 * Time: 13:40
	 *
	 * @var $model \app\models\ToursDates;
	 */
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\models\Bookings;
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
					Bookings::FIELD_BABIES
				],
			]) ?>
		</div>
	</div>
</div>
