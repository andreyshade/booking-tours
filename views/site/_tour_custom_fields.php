<?php
	/**
	 * Created by PhpStorm.
	 * User: andreyshade
	 * Date: 01.02.16
	 * Time: 21:58
	 *
	 * @var $model CustomFields
	 */
use yii\helpers\Html;
use app\models\ToursDates;
use app\models\Bookings;
use app\models\CustomFields;

?>
<div class="col-sm-3">
	<div class="panel panel-default">
		<div class="panel-heading text-center">
			<?= Html::tag('h4', $model->label)?>
		</div>
		<div class="panel-body">
			<?= Html::a('Delete', ['delete-custom-field', CustomFields::FIELD_CUSTOM_FIELD_ID => $model->custom_field_id],
				['class' => 'btn btn-danger', 'data-confirm' => Yii::t('yii', 'Are you sure you want to delete "' . $model->label . '" custom field?')])?>
		</div>
	</div>
</div>
