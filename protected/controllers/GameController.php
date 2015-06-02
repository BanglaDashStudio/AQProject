<?php

class GameController extends Controller
{
	public function actionCreate()
    {
        $model = new GameCreate;

        if (isset($_POST['Game'])) {
            $model->attributes = $_POST['Game'];
            if ($model->validate()) {
                if ($model->save() )
                $this->redirect(Yii::app()->createUrl('game/MyGames'));
                return;
            }
            $this->render('Create', array('model' => $model));
        }
        $this->render('Create', array('model' => $model));

    }

	public function actionPlay()
	{
        $gameList=Game::model()->findAllByAttributes(array('AcceptGame'=>'1')) ;
		$this->render('Play', array('model'=>$gameList));
	}

    public function actionMyGames()
    {
        $gameList=Game::model()->findAllByAttributes(array('AcceptGame'=>'1')) ;
        $this->render('MyGames', array('model'=>$gameList));
    }

    public function actionListGame($idGame)
    {
        $game = Game::model()->findById($idGame);
        $this->render('MyGames', array('model'=>$game-NameGame));
    }


    public function actionEdit($idGame)
    {
        $modelGame = new Game;
        $game = Game::model()->findById($idGame);

        if($game == null){
            echo 'Ошибка';
            return;
        }
        $modelGame-> name = $game->name;
        $modelGame-> date = $game->date;
        $modelGame-> z1= $game->z1;
        $modelGame-> z2= $game->z2;
        $modelGame-> z3= $game->z3;

        if(isset($_POST['ajax']) && $_POST['ajax']==='edit-form')
        {
            echo CActiveForm::validate($modelGame);
            Yii::app()->end();
        }

        if(isset($_POST['Game']))
        {
            var_dump($_POST['Game']);
            $modelGame-> attributes=$_POST['Game'];

            if($modelGame->validate())
            {
                $game->name = $_POST['Game']['name'];
                $game->date = $_POST['Game']['date'];
                $game->z1 = $_POST['Game']['z1'];
                $game->z2 = $_POST['Game']['z2'];
                $game->z3 = $_POST['Game']['z3'];

                if($game->save()) {
                    $this->render('Edit', array('Game' => $modelGame));
                    return;
                }
            }
        }

        $this->render('Edit', array('Game'=>$modelGame));
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