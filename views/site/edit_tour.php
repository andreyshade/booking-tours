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

<?php $this->title = 'Edit tour' ?>
<?php $this->params['breadcrumbs'][] = ['label' => 'Manage Tours', 'url' => 'manage-tours']?>
<?php $this->params['breadcrumbs'][] = $this->title ?>

<?= Html::tag('h1', $this->title)?>

<?= $this->render('_tour_form', [
	'model' => $model
])?>
