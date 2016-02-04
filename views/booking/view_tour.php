<?php
	/**
	 * Created by PhpStorm.
	 * User: andreyshade
	 * Date: 04.02.16
	 * Time: 18:50
	 *
	 *
	 * @var $model Tours
	 * @var $dataProvider \yii\data\ActiveDataProvider
	 *
	 */

use yii\helpers\Html;
use yii\widgets\ListView;
use app\models\Tours;
?>


<?php $this->title = 'Tour date choosing' ?>
<?php $this->params['breadcrumbs'][] = $this->title ?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<?= Html::tag('h1', $model->title)?>
<br>
<div class="text-center">
	<?= Html::tag('h3', 'Please choose tour date')?>
</div>
<?= Html::tag('legend', 'Available Dates')?>
<div class="row">
	<?= ListView::widget([
			'dataProvider' => $dataProvider,
			'showOnEmpty' => false,
			'emptyText' => '<div class="col-sm-12">No availabe tour dates found</div>',
			'itemView' => '_tour_dates',
			'layout' => '{items}'
])?>
</div>


