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
		</div>
	</div>
</div>
