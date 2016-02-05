<?php
	/**
	 * Created by PhpStorm.
	 * User: andreyshade
	 * Date: 05.02.16
	 * Time: 15:01
	 *
	 * @var $dataProvider ActiveDataProvider
	 * @var $model ToursDates
	 * @var $this \yii\web\View
 	 */

use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\grid\ActionColumn;
use app\models\Bookings;
use app\models\ToursDates;
use app\models\Tours;

$this->title = 'Booking results on ' . $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Edit Tour', 'url' => ['edit-tour', Tours::FIELD_TOUR_ID => $model->tour_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<?= Html::tag('h1', $this->title)?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
    'emptyText' => 'No available Booking places to display',
    'columns' => [
		Bookings::FIELD_NAME,
		Bookings::FIELD_ADULTS,
		Bookings::FIELD_CHILDREN,
		Bookings::FIELD_CHILDREN,
		Bookings::FIELD_BABIES,
		[
			'class' => ActionColumn::className(),
			'template' => '{delete}',
			'contentOptions' => ['class' => 'text-center'],
			'buttons' => [
				'delete' => function($url, $model, $key) {
                        /* @var $model Bookings */
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete-booking', Bookings::FIELD_BOOKING_ID=> $model->booking_id]);
                    }
			]
		]
	]
])?>
