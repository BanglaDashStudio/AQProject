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
        $gameActualList = Game::model()->findByAttributes(array('AcceptGame'=>1));

        foreach ($gameList as $item){
            //array_push($gameArray, $item->NameGame);
            $gameArray[$item->IdGame] = $item->NameGame;
        }

        if(!$gameActualList == NULL) {
            $gameActual = $gameActualList->NameGame;
        }else{
            $gameActual = 'На сегодня игр нет';
        }

        $this->render('gamechange', array('gameArray'=>$gameArray, 'gameActual'=>$gameActual));
    }

    public function actionChangeId()
    {
        if (isset($_POST['listname'])){
            $gameActual = Game::model()->findByAttributes(array('AcceptGame'=>1));
            $gameActual->AcceptGame = 0;
            if($gameActual->save()){
                echo 'dsv';
            }

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