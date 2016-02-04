<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */
    use yii\grid\DataColumn;
    use yii\grid\GridView;
    use yii\db\Query;
    use yii\db\Expression;
    use app\models\ToursDates;
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
                        /* @var $model Tours*/
                        $query = new Query();
                        $query->select(ToursDates::FIELD_DATE)
                            ->from(ToursDates::tableName())
                            ->where([ToursDates::FIELD_TOUR_ID => $model->tour_id])
                            ->andWhere(['>=', ToursDates::FIELD_DATE, date('Y-m-d')])
                            ->orderBy([ToursDates::FIELD_DATE => SORT_ASC]);
                        $result = $query->one();
                        return $result[ToursDates::FIELD_DATE];
                    }
                ],
                [
                    'class' => \yii\grid\ActionColumn::className()
                ]
            ]
        ])?>
    </div>
</div>
