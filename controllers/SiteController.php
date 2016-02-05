<?php

	namespace app\controllers;

	use Yii;
	use yii\data\ActiveDataProvider;
	use yii\db\Query;
	use yii\filters\AccessControl;
	use yii\helpers\ArrayHelper;
	use yii\web\Controller;
	use yii\filters\VerbFilter;
	use app\models\LoginForm;
	use app\models\ContactForm;
	use app\models\Tours;
	use app\models\ToursTime;
	use app\models\TourForm;
	use app\models\Bookings;
	use app\models\ToursDates;
	use app\models\ToursDatesForm;

	class SiteController extends Controller
	{
		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'only' => ['logout'],
					'rules' => [
						[
							'actions' => ['logout'],
							'allow' => true,
							'roles' => ['@'],
						],
					],
				],
				'verbs' => [
					'class' => VerbFilter::className(),
					'actions' => [
						'logout' => ['post'],
					],
				],
			];
		}

		public function actions()
		{
			return [
				'error' => [
					'class' => 'yii\web\ErrorAction',
				],
				'captcha' => [
					'class' => 'yii\captcha\CaptchaAction',
					'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
				],
			];
		}

		public function actionIndex()
		{
			$dataProvider = new ActiveDataProvider([
				'query' => Tours::find()
			]);
			return $this->render('index', [
				'dataProvider' => $dataProvider
			]);
		}

		public function actionLogin()
		{
			if (!\Yii::$app->user->isGuest) {
				return $this->goHome();
			}

			$model = new LoginForm();
			if ($model->load(Yii::$app->request->post()) && $model->login()) {
				return $this->goBack();
			}
			return $this->render('login', [
				'model' => $model,
			]);
		}

		public function actionLogout()
		{
			Yii::$app->user->logout();

			return $this->goHome();
		}

		public function actionContact()
		{
			$model = new ContactForm();
			if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
				Yii::$app->session->setFlash('contactFormSubmitted');

				return $this->refresh();
			}
			return $this->render('contact', [
				'model' => $model,
			]);
		}

		public function actionAbout()
		{
			return $this->render('about');
		}

		public function actionManageTours()
		{
			$dataProvider = new ActiveDataProvider([
				'query' => Tours::find()
			]);

			return $this->render('manage_tours', [
				'dataProvider' => $dataProvider
			]);
		}

		public function actionAddNewTour()
		{
			$model = new TourForm();

			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				Yii::$app->session->setFlash('success', 'Tour successful added');
				$this->redirect('manage-tours');
			}

			return $this->render('add_new_tour', [
				'model' => $model
			]);
		}

		public function actionDeleteTour($tour_id)
		{
			if (!$tour = Tours::findOne($tour_id)) {
				Yii::$app->session->setFlash('danger', 'Tour does not exists');
				return $this->redirect('manage-tours');
			}

			$query = new Query();
			$query->select([ToursDates::FIELD_TOUR_DATE_ID])
				->from(ToursDates::tableName())
				->where([ToursDates::FIELD_TOUR_ID => $tour_id]);
			$dates_id = ArrayHelper::getColumn($query->all(), ToursDates::FIELD_TOUR_DATE_ID);


			if ($bookings = Bookings::findAll([Bookings::FIELD_TOUR_DATE_ID => $dates_id])) {
				Yii::$app->session->setFlash('danger', 'This tour can not delete because it has a reserved places');
				return $this->redirect('manage-tours');
			}

			ToursDates::deleteAll([ToursDates::FIELD_TOUR_ID => $tour_id]);

			$tour->delete();
			Yii::$app->session->setFlash('success', 'Tour successful deleted');
			$this->redirect('manage-tours');
		}

		public function actionViewTour($tour_id)
		{
			$model = Tours::findOne($tour_id);
			$dataProvider = new ActiveDataProvider([
				'query' => ToursDates::find()->where([ToursDates::FIELD_TOUR_ID => $tour_id])
			]);

			return $this->render('view_tour',[
				'model' => $model,
				'dataProvider' => $dataProvider
			]);
		}

		public function actionEditTour($tour_id)
		{
			$tour = Tours::findOne($tour_id);
			$model = new TourForm();
			$model->initForm($tour);

			$tourDateForm = new ToursDatesForm();

			$dataProvider = new ActiveDataProvider([
				'query' => ToursDates::find()->where([ToursDates::FIELD_TOUR_ID => $tour_id])
			]);

			if ($model->load(Yii::$app->request->post(), 'TourForm') && $model->save()) {
				Yii::$app->session->setFlash('success', 'Tour successful updated');
				$this->redirect('manage-tours');
			}

			if ($tourDateForm->load(Yii::$app->request->post(), 'ToursDatesForm') && $tourDateForm->save()) {
				Yii::$app->session->setFlash('success', 'New date successful added');
				$this->redirect(['edit-tour', Tours::FIELD_TOUR_ID => $tour_id]);
			}

			return $this->render('edit_tour', [
				'model' => $model,
				'tourDateForm' => $tourDateForm,
				'dataProvider' => $dataProvider
			]);

		}

		public function actionDeleteTourDate($tour_date_id)
		{
			$tour_date = ToursDates::findOne($tour_date_id);
			if ($bookings = Bookings::findAll([Bookings::FIELD_TOUR_DATE_ID => $tour_date_id])) {
				Yii::$app->session->setFlash('danger', 'This date can not delete because it has a reserved places');
				$this->redirect(['edit-tour', Tours::FIELD_TOUR_ID => $tour_date->tour_id]);

			}
			$tour_date->delete();
			Yii::$app->session->setFlash('success', 'Tours date successful deleted');
			$this->redirect(['edit-tour', Tours::FIELD_TOUR_ID => $tour_date->tour_id]);
		}

		public function actionViewDetailsTourDate($tour_date_id)
		{
			$model = ToursDates::findOne($tour_date_id);
			$dataProvider = new ActiveDataProvider([
				'query' => Bookings::find()->where([Bookings::FIELD_TOUR_DATE_ID => $tour_date_id])
			]);

			return $this->render('details_tour_date', [
				'model' => $model,
				'dataProvider' => $dataProvider
			]);
		}


	}
