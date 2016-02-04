<?php

namespace app\controllers;

use Yii;
use app\models\BookingsForm;
use yii\data\ActiveDataProvider;
use app\models\Tours;
use app\models\ToursDates;

class BookingController extends \yii\web\Controller
{
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
    
    public function actionBookPlace($tour_date_id)
    {
        $model = new BookingsForm();
        $tour_date = ToursDates::findOne($tour_date_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Congratulations! Places successful booked');
            return $this->redirect(['tour-details', Tours::FIELD_TOUR_ID => $tour_date->tour_id]);
        }

        return $this->render('book_place', [
            'model' => $model,
            'tour_date' => $tour_date
        ]);
    }

}
