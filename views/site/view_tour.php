<?php
/**
 * Created by PhpStorm.
 * User: andreyshade
 * Date: 01.02.16
 * Time: 14:41
 *
 * @var $this \yii\web\View
 * @var $model \app\models\Tours;
 *
 */
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;
use app\models\TourForm;
use app\models\Tours;
?>

<?php $this->title = 'View tour' ?>
<?php $this->params['breadcrumbs'][] = ['label' => 'Manage Tours', 'url' => 'manage-tours']?>
<?php $this->params['breadcrumbs'][] = $this->title ?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<?= Html::tag('h1', $this->title)?>

<?= Html::tag('h2', $model->title)?>
<br>
<legend>Tour info</legend>
<div class="row">
	<div class="col-sm-4 text-center">
		<?= $model->generateAttributeLabel(Tours::FIELD_MAX_ADULTS)?>: <?= Html::tag('b', $model->max_adults)?>
	</div>
	<div class="col-sm-4 text-center">
		<?= $model->generateAttributeLabel(Tours::FIELD_MAX_CHILDREN)?>: <?= Html::tag('b', $model->max_children)?>
	</div>
	<div class="col-sm-4 text-center">
		<?= $model->generateAttributeLabel(Tours::FIELD_MAX_BABIES)?>: <?= Html::tag('b', $model->max_babies)?>
	</div>
</div>
<br>
<legend>Available dates of tours</legend>

