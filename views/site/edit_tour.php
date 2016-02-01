<?php
/**
 * Created by PhpStorm.
 * User: andreyshade
 * Date: 01.02.16
 * Time: 14:41
 *
 * @var $this \yii\web\View
 * @var $model \app\models\Tours
 * @var $dataProvider \yii\data\ActiveDataProvider
 *
 */
use yii\bootstrap\Html;
use yii\widgets\ListView;
?>

<?php $this->title = 'Edit tour' ?>
<?php $this->params['breadcrumbs'][] = ['label' => 'Manage Tours', 'url' => 'manage-tours']?>
<?php $this->params['breadcrumbs'][] = $this->title ?>

<?= Html::tag('h1', $this->title)?>

<?= $this->render('_tour_form', [
	'model' => $model
])?>
<br>
<legend>Tour dates</legend>
<div class="row">
	<?= ListView::widget([
			'dataProvider' => $dataProvider,
			'showOnEmpty' => false,
			'emptyText' => '<div class="col-sm-12">No availabe tour dates found</div>',
			'itemView' => '_tour_dates',
			'layout' => '{items}'
	])?>
</div>
<div class="row text-right">
	<?= Html::a('Add New Date', 'add-tour-date', ['class' => 'btn btn-success'])?>
</div>
