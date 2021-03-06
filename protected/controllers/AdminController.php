<?php

class AdminController extends Controller
{
	public function actionComandmanage()
	{
        $this->redirect(Yii::app()->createUrl('team'));
	}

	public function actionGamemanage()
	{
		$this->render('gamemanage');
	}

    public function actionGamechange()
    {
        $gameList=Game::model()->findAll();
        $gameArray = array();
        $gameActualList = Game::model()->findByAttributes(array('accepted'=>1));
        $gameArray[-1] = '...';
        foreach ($gameList as $item){
            $gameArray[$item->id] = $item->name;
        }

        if(!$gameActualList == NULL) {
            $gameActual = $gameActualList->name;
        }else{
            $gameActual = 'На сегодня игр нет';
        }

        $this->render('gamechange', array('gameArray'=>$gameArray, 'gameActual'=>$gameActual));
    }

    public function actionChangeId()
    {
        if(isset($_POST['listname'])){
            $gameActual = Game::model()->findByAttributes(array('accepted'=>1));
            $gameList = Game::model()->findByPk($_POST['listname']);

            if ($gameActual !== NULL) {

                $gameActual->accepted = '0';

                if ($gameActual->save()) {
                    $this->unsetOrgRole($gameActual);

                    if ($_POST['listname'] != -1) {
                        $gameList->accepted = '1';

                        if ($gameList->save()) {
                            $this->setOrgRole($gameList);
                            $this->redirect(Yii::app()->createUrl('Admin/gamechange'));
                        }
                    }
                    $this->redirect(Yii::app()->createUrl('Admin/gamechange'));
                }
            } else {

                $gameList->accepted = '1';
                if ($gameList->save()) {
                    $this->setOrgRole($gameList);
                    $this->redirect(Yii::app()->createUrl('Admin/gamechange'));
                }
            }
        }

    }

    private function setOrgRole($game) {
        if(isset($game->teamId)) {
            $team = Team::model()->findByPk($game->teamId);
            if ($team->role == 0 || $team->role == 3){//user or creator
                $team->role += 2;//org
            }

            if(!$team->save()) {
                echo 'не проставилась роль орг';
            }
        }
    }

    private function unsetOrgRole($game) {
        if(isset($game->teamId)){
            $team = Team::model()->findByPk($game->teamId);
            if($team->role == 2 || $team->role == 5) {//org
                $team->role -= 2;//user or creator
            }

            if(!$team->save()) {
                echo 'не вернулась роль юзер';
            }
        }


        //unset all users
        $teams = Team::model()->findAllByAttributes(array('role'=>2));

        foreach($teams as $teamItem) {
            $teamItem->role = 0;
        }

        //unset all creators
        $teams = Team::model()->findAllByAttributes(array('role'=>5));

        foreach($teams as $teamItem) {
            $teamItem->role = 3;
        }
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                // TODO: тупое решение с правами админа, лучше изменить
                'roles'=>array('admin'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'accessControl',
        );
    }
	/*
	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}