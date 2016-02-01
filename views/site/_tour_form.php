<?php
	/**
	 * Created by PhpStorm.
	 * User: andreyshade
	 * Date: 01.02.16
	 * Time: 19:42
	 *
	 * $@var $model Tours;
	 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Tours;
use app\models\TourForm;

?>
<?php $form = ActiveForm::begin([
	'options' => ['class' => 'form-horizontal'],
	'fieldConfig' => [
		'template' => "{label}\n<div class=\"col-sm-3\">{input}</div>\n<div class=\"col-sm-9 col-sm-offset-2\">{error}</div>",
		'labelOptions' => ['class' => 'col-sm-2 control-label'],
	]
])?>

	<?= $form->field($model, TourForm::FIELD_TITLE);?>

	<?= $form->field($model, TourForm::FIELD_MAX_ADULTS)->input('number', ['min' => 0])?>

	<?= $form->field($model, TourForm::FIELD_MAX_CHILDREN)->input('number', ['min' => 0])?>

	<?= $form->field($model, TourForm::FIELD_MAX_BABIES)->input('number', ['min' => 0])?>
	<div class="row">
		<div class="col-sm-12">
				<?= Html::a('Back', 'manage-tours', ['class' => 'btn btn-default'])?>
			<div class="pull-right">
				<?= Html::submitButton('Save', ['class' => 'btn btn-primary'])?>
			</div>
		</div>
	</div>
<?php ActiveForm::end();?>
