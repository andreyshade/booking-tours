<?php
/**
 * Created by PhpStorm.
 * User: andreyshade
 * Date: 01.02.16
 * Time: 14:41
 *
 * @var $this \yii\web\View
 *
 */
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;
use app\models\TourForm;
?>

<?php $this->title = 'Add New Tour' ?>
<?php $this->params['breadcrumbs'][] = ['label' => 'Manage Tours', 'url' => 'manage-tours']?>
<?php $this->params['breadcrumbs'][] = $this->title ?>

<?= Html::tag('h1', $this->title)?>

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

	<?= Html::submitButton('Save', ['class' => 'btn btn-primary'])?>

<?php ActiveForm::end();?>
