<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use app\models\Tours;
use app\models\ToursDates;

class BookingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTourDetails($tour_id)
    {
        $model = Tours::findOne($tour_id);

        $dataProvider = new ActiveDataProvider([
				'query' => ToursDates::find()
                    ->where([ToursDates::FIELD_TOUR_ID => $tour_id])
                    ->andWhere(['>=', ToursDates::FIELD_DATE, date('Y-m-d')])
        ]);

        return $this->render('view_tour', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }

}
