<?php
	/**
	 * Created by PhpStorm.
	 * User: andreyshade
	 * Date: 04.02.16
	 * Time: 20:48
	 *
	 * @var $model \app\models\BookingsForm
	 * @var $tour_date \app\models\ToursDates
	 * @var $this \yii\web\View
	 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Tours;
use app\models\BookingsForm;
?>

<?php $this->title = 'Book place' ?>
<?php $this->params['breadcrumbs'][] = ['label' => 'Tour date choosing', 'url' => ['tour-details', Tours::FIELD_TOUR_ID => $tour_date->tour_id]]?>
<?php $this->params['breadcrumbs'][] = $this->title ?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>
<?= Html::tag('h1', $this->title . ' on date: ' . $tour_date->date)?>
<?= Html::tag('p', 'Please fill following fields:')?>

<?php $form = ActiveForm::begin([
	'options' => ['class' => 'form-horizontal'],
	'fieldConfig' => [
		'template' => "{label}\n<div class=\"col-sm-3\">{input}</div>\n<div class=\"col-sm-9 col-sm-offset-2\">{error}</div>",
		'labelOptions' => ['class' => 'col-sm-2 control-label'],
	]
])?>
	<?= $form->field($model, BookingsForm::FIELD_TOUR_DATE_ID)->hiddenInput(['value'=> $tour_date->tour_date_id])->label(false)?>

	<?= $form->field($model, BookingsForm::FIELD_NAME);?>

	<?= $form->field($model, BookingsForm::FIELD_ADULTS)->input('number', ['min' => 0, 'value' => 0])?>

	<?= $form->field($model, BookingsForm::FIELD_CHILDREN)->input('number', ['min' => 0, 'value' => 0])?>

	<?= $form->field($model, BookingsForm::FIELD_BABIES)->input('number', ['min' => 0, 'value' => 0])?>
	<div class="row">
		<div class="col-sm-12">
				<?= Html::a('Back', ['tour-details', Tours::FIELD_TOUR_ID => $tour_date->tour_id], ['class' => 'btn btn-default'])?>
			<div class="pull-right">
				<?= Html::submitButton('Confirm', ['class' => 'btn btn-success'])?>
			</div>
		</div>
	</div>
<?php ActiveForm::end();?>
