<?php

class ManualTestingToolsController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}


	public function actionUserChange($user) {

		Yii::app()->user->logout();

		if($user == 'admin') {
			$identity = new UserIdentity($user, 'admin');
		} elseif($user == 'ухо') {
			$identity = new UserIdentity($user, 'горло');
		}

		if($identity->authenticate()) {
			Yii::app()->user->login($identity, 3600*10);
		} else {
			echo $identity->errorMessage;
		}

		$this->render('index');
	}

	public function actionUserChangeWithPassword() {
		$user = $_POST['ManualTestingTools']['user'];
		$pass = $_POST['ManualTestingTools']['pass'];

		if(isset($user) && isset($pass)) {
			$identity = new UserIdentity($user, $pass);

			if ($identity->authenticate()) {
				Yii::app()->user->logout();
				Yii::app()->user->login($identity, 3600 * 10);
			} else {
				echo $identity->errorMessage;
			}
		}
		$this->render('index');
	}

	public function actionGameStartChange() {
		if(isset($_POST['ManualTestingTools']['gameStart'])){
			if(is_numeric($_POST['ManualTestingTools']['gameStart'])){
				$offset = $_POST['ManualTestingTools']['gameStart']*60;
				$game = Game::model()->findByAttributes(array('accepted'=>1));
				if(isset($game)) {
					$game->date = time()+$offset;
					$game->save();
				} else {
					echo 'не нашел';
				}
			} else {
				echo 'не число';
			}
		}
		$this->render('index');
	}

	public function actionGameChange() {
		if(isset($_POST['ManualTestingTools']['game'])){
			if(is_numeric($_POST['ManualTestingTools']['game'])){
				$game = Game::model()->findByAttributes(array('accepted'=>1));
				$game->accepted = 0;
				$game->save();
				$game = Game::model()->findByPk($_POST['ManualTestingTools']['game']);
				$game->accepted = 1;
				$game->save();
			}
		}
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed

	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('deny',  // deny all users
				'expression'=>'YII_DEBUG===false',
			),
		);
	}

}