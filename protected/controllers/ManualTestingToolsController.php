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

		$this->redirect($this->createUrl('index'));
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
		$this->redirect($this->createUrl('index'));
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
		$this->redirect($this->createUrl('index'));
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

				$orgs = Team::model()->findAllByAttributes(array('role'=>2));
				foreach($orgs as $org){
					$org->role -= 2;
					$org->save();
				}

				$org = Team::model()->findByPk($game->teamId);
				$org->role += 2;
				$org->save();
			}
		}
		$this->redirect($this->createUrl('index'));
	}


	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('deny',
				'expression'=>'YII_DEBUG===false',
			),
		);
	}

}