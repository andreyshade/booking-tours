<?php
/**
 * Created by PhpStorm.
 * User: andreyshade
 * Date: 01.02.16
 * Time: 14:41
 *
 * @var $this \yii\web\View
 * @var $model \app\models\Tours
 * @var $tourDateForm \app\models\ToursDatesForm;
 * @var $dataProvider \yii\data\ActiveDataProvider
 *
 */
use yii\bootstrap\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use app\models\ToursDatesForm;
?>

<?php $this->title = 'Edit tour' ?>
<?php $this->params['breadcrumbs'][] = ['label' => 'Manage Tours', 'url' => 'manage-tours']?>
<?php $this->params['breadcrumbs'][] = $this->title ?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

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
<div class="row">
	<div class="col-sm-12 text-right">
		<?php $form = ActiveForm::begin([
			'options' => ['class' => 'form-inline'],
			'fieldConfig' => [
				'template' => "{input}"
			]
		])?>
			<?= $form->field($tourDateForm, ToursDatesForm::FIELD_TOUR_ID)->hiddenInput(['value' => $model->tour_id])?>
			<?= $form->field($tourDateForm, ToursDatesForm::FIELD_DATE)->input('date')?>

			<?= Html::submitButton('Add New Date', ['class' => 'btn btn-success'])?>

		<?php ActiveForm::end();?>
	</div>
</div>
