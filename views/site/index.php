<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */
use yii\grid\GridView;
use yii\grid\DataColumn;
use app\models\Tours;

$this->title = 'Booking tours';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to Booking Tours service!</h1>

        <p class="lead">Chose available tour to continue</p>

    </div>

    <div class="body-content">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'emptyText' => 'No available tours at this moment',
            'columns' => [
                [
                    'class' => DataColumn::className(),
                    'attribute' => Tours::FIELD_TITLE,
                ],
                [
                    'class' => DataColumn::className(),
                    'label' => 'Nearest Tour',
                    'value' => function ($model) {
                        return 'Soon';
                    }
                ],
                [
                    'class' => \yii\grid\ActionColumn::className()
                ]
            ]
        ])?>
    </div>
</div>
