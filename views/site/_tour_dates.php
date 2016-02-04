<?php
	/**
	 * Created by PhpStorm.
	 * User: andreyshade
	 * Date: 01.02.16
	 * Time: 21:58
	 *
	 * @var $model ToursDates
	 */
use yii\helpers\Html;
use app\models\ToursDates;
use app\models\Bookings;

?>
<div class="col-sm-3">
	<div class="panel panel-default">
		<div class="panel-heading text-center">
			<?= Html::tag('h4', $model->date)?>
		</div>
		<div class="panel-body">
			<h5 class="text-center">Booked places</h5>
			<table class="table">
				<tr>
					<td><?= Html::tag('b', 'Adults:')?></td><td><?= $model->getBookedPlaces(Bookings::FIELD_ADULTS);?></td>
				</tr>
				<tr>
					<td><?= Html::tag('b', 'Children:')?></td><td><?= $model->getBookedPlaces(Bookings::FIELD_CHILDREN)?></td>
				</tr>
				<tr>
					<td><?= Html::tag('b', 'Babies:')?></td><td><?= $model->getBookedPlaces(Bookings::FIELD_BABIES)?></td>
				</tr>
  			</table>
			<?= Html::a('Delete', ['delete-tour-date', ToursDates::FIELD_TOUR_DATE_ID => $model->tour_date_id],
				['class' => 'btn btn-danger', 'data-confirm' => Yii::t('yii', 'Are you sure you want to delete ' . $model->date . ' date?')])?>
			<div class="pull-right">
				<?= Html::a('View Details', ['view-details-tour-date', ToursDates::FIELD_TOUR_DATE_ID => $model->tour_date_id],
					['class' => 'btn btn-primary'])?>
			</div>
		</div>
	</div>
</div>
