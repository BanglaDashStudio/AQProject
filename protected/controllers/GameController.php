<?php

class GameController extends Controller
{
	public function actionCreate()
    {
        $model = new Game;
        if (isset($_POST['Game'])) {
            $model->attributes = $_POST['Game'];
            if ($model->validate()) {
                $model->save();
                return;

            }
            $this->render('Create', array('model' => $model));
        }
    }

	public function actionPlay()
	{
        $model=new Game;

        $gameList=Game::model()->findAllByAttributes(array('date'=>'2015-05-23 00:00:00')) ;
		$this->render('Play', array('model'=>$gameList));

	}

    public function actionMyGames()
    {
        $gameList=Game::model()->findAllByAttributes(array('name'=>'345')) ;
        $this->render('MyGames', array('model'=>$gameList));
    }

    public function actionListGame($id)
    {
        $game = Game::model()->findById($id);
        $this->render('MyGames', array('model'=>$game-name));
    }


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

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