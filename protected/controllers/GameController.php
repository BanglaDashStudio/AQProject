<?php

class GameController extends Controller
{
	public function actionCreate()
    {
        $model = new GameCreate;

        if (isset($_POST['GameCreate'])) {
            $model->attributes = $_POST['GameCreate'];
            if ($model->validate()) {

                $game = new Game;

                $game->NameGame=$model->NameGame;
                $game->DescriptionGame=$model->DescriptionGame;
                $game->StartGame=$model->StartGame;
                $game->Date=$model->Date;
                $game->FinishGame=$model->FinishGame;
                $game->Comment=$model->Comment;
                $game->IdTeam = Yii::app()->user->id;

                if ($game->save()) {
                    $this->redirect(Yii::app()->createUrl('game/Tasks'));
                    return;
                }else echo'bue';
            }else{
                $this->render('Create', array('model' => $model));
                return;
            }
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
        $gameList=Game::model()->findAllByAttributes(array('IdTeam'=>Yii::app()->user->id));
        $this->render('MyGames', array('model'=>$gameList));
    }

    public function actionListGame($idGame)
    {
        $game = Game::model()->findById($idGame);
        $this->render('MyGames', array('model'=>$game-NameGame));
    }


public function actionTasks()
{

    $model = new GameCreate;
     $this->render('Tasks',array('model'=>$model));
}

    public function actionEdit($idGame)
    {
        $modelGame = new Game;
        $game = Game::model()->findById($idGame);

        if($game == null){
            echo 'Ошибка';
            return;
        }
        $modelGame-> name = $game->NameGame;
        $modelGame-> date = $game->DescriptionGame;
        $modelGame-> StartGame= $game->StartGame;
        $modelGame-> FinishGame= $game->FinishGame;
        $modelGame-> Comment= $game->Comment;

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
                $game->NameGame = $_POST['Game']['NameGame'];
                $game->DescriptionGame = $_POST['Game']['DescriptionGame'];
                $game->StartGame = $_POST['Game']['StartGame'];
                $game->FinishGame = $_POST['Game']['FinishGame'];
                $game->Comment = $_POST['Game']['Comment'];

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