<?php

	namespace app\controllers;

	use Yii;
	use yii\data\ActiveDataProvider;
	use yii\filters\AccessControl;
	use yii\web\Controller;
	use yii\filters\VerbFilter;
	use app\models\LoginForm;
	use app\models\ContactForm;
	use app\models\Tours;
	use app\models\ToursTime;
	use app\models\TourForm;
	use app\models\Bookings;

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
				Yii::$app->session->setFlash('error', 'Tour does not exists');
				$this->redirect('manage-tours');
			}
			if (Bookings::findAll([Bookings::FIELD_TOUR_ID => $tour_id])) {
				Yii::$app->session->setFlash('error', 'This tour can not delete because it has a reserved places');
				$this->redirect('manage-tours');
			}
			$tour->delete();


			Yii::$app->session->setFlash('success', 'Tour successful deleted');
			$this->redirect('manage-tours');
		}

		public function actionViewTour($tour_id)
		{
			$model = Tours::findOne($tour_id);
			return $this->render('view_tour',[
				'model' => $model
			]);
		}

		public function actionEditTour($tour_id)
		{
			$tour = Tours::findOne($tour_id);
			$model = new TourForm();
			$model->initForm($tour);

			$dataProvider = new ActiveDataProvider([
				'query' => ToursTime::find($tour_id)
			]);

			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				Yii::$app->session->setFlash('success', 'Tour successful updated');
				$this->redirect('manage-tours');
			}

			return $this->render('edit_tour', [
				'model' => $model,
				'dataProvider' => $dataProvider
			]);

		}
	}
