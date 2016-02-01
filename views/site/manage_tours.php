<?php
/**
 * Created by PhpStorm.
 * User: andreyshade
 * Date: 30.01.16
 * Time: 23:03
 *
 * @var $this \yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use app\models\Tours;
use app\models\TourForm;

$this->title = 'Manage tours';
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
    'emptyText' => 'No available Tours to display',
    'columns' => [
        [
            'class' => DataColumn::className(),
            'attribute' => Tours::FIELD_TOUR_ID,
        ],
        [
            'class' => DataColumn::className(),
            'attribute' => Tours::FIELD_TITLE,
        ],
        [
            'class' => DataColumn::className(),
            'attribute' => Tours::FIELD_MAX_ADULTS,
        ],
        [
            'class' => DataColumn::className(),
            'attribute' => Tours::FIELD_MAX_CHILDREN
        ],
        [
            'class' => DataColumn::className(),
            'attribute' => Tours::FIELD_MAX_BABIES
        ],
        [
            'class' => ActionColumn::className()
        ]
    ]
]);?>
<div class="row">
        <div class="col-sm-12">
                <?= Html::a('Add new tour', 'add-new-tour', ['class' => 'btn btn-success'])?>
        </div>
</div>