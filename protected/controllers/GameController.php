<?php

class GameController extends Controller
{

    // создание игры
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
                    $this->redirect(Yii::app()->createUrl('game/Tasks', array('idG' =>$game->IdGame)));
                    return;
                }else echo'bue';
            }else{
                $this->render('Create', array('model' => $model));
                return;
            }
        }
        $this->render('Create', array('model' => $model));
    }

    // текущая игра
	public function actionPlay()
	{
        $gameAccept=Game::model()->findByAttributes(array('AcceptGame'=>'1'));

        $criteria = new CDbCriteria();

        if (!isset($gameAccept)) {
            $this->render('Play', array('model'=>NULL,'teamList'=>NULL));
        } else {

            $criteria->condition = $this->getGameTeam($gameAccept->IdGame);

            if (isset($criteria->condition)) {
                $teamList = Team::model()->findAll($criteria);
            } else {
                $teamList = null;
            }
            $this->render('Play', array('model' => $gameAccept, 'teamList' => $teamList));
        }
	}

    private function getGameTeam ($id) {
        $teams = Gameteam::model()->findAllByAttributes(array('IdGame'=>$id));
        $condition = "";
        if(isset($teams)){
            $first = true;
            foreach ($teams as $team) {
                if ($first) {
                    $condition = "IdTeam=".$team->IdTeam;
                    $first = false;
                } else {
                    $condition .= " or IdTeam=".$team->IdTeam;
                }
            }
        }else{
            return null;
        }

        if($condition === "") {
            return null;
        }

        return $condition;
    }

    public function actionNewOrder($IdGame, $IdTeam)
    {
        $newOrder = new Gameteam;
        $newOrder->IdTeam = $IdTeam;
        $newOrder->IdGame = $IdGame;

        if ($newOrder->save()) {
            $this->redirect(Yii::app()->createUrl('game/Play'));
        }else {

        }

    }

    public function actionDeleteOrder($IdGame, $IdTeam)
    {
        Gameteam::model()->deleteAllByAttributes(array('IdGame'=>$IdGame,'IdTeam'=>$IdTeam));
        $this->redirect(Yii::app()->createUrl('game/Play'));
    }

   //список игр 1 команды
    public function actionMyGames()
    {
        $gameList=Game::model()->findAllByAttributes(array('IdTeam'=>Yii::app()->user->id));
        $this->render('MyGames', array('model'=>$gameList));
    }

    // для ссылок на игры
    public function actionListGame($idGame)
    {
        $game = Game::model()->findById($idGame);
        $this->render('MyGames', array('model'=>$game-NameGame));
    }

    // добавление заданий
    public function actionTasks($idG)
    {
        if (!isset($idG))
            return;

        $model = new TaskCreateForm;
        $task =  Task::model()->findAllByAttributes(array('IdGame'=>$idG));
        $this->render('Tasks',array('TaskCreate'=>$model, 'Task' => $task, 'idG'=>$idG));
    }

   //Добавление одного задания
    public function actionTaskCreate($idG)
    {

        //var_dump($_POST);
        //return;

        if (isset($_POST['TaskCreateForm'])) {
            $model = new TaskCreateForm;

            //$model->attributes = $_POST['TaskCreateForm'];



            $task = new Task;

            $task->IdGame = $idG;
            $task->NameTask = $_POST['TaskCreateForm']['taskname'];
            $task->DescriptionTask = $_POST['TaskCreateForm']['task'];

            //$task->DescriptionTask = $model->task;

            if ($task->save()) {
                $code = new Code;
                $hint = new Hint;

                $code->Cod = $_POST['TaskCreateForm']['code'];
                $code->IdTask = $task->IdTask;

                $hint->DescriptionHint = $_POST['TaskCreateForm']['tip'];
                $hint->IdTask = $task->IdTask;

                if ($code->save() && $hint->save()) {
                    $this->redirect(Yii::app()->createUrl('game/Tasks', array('idG' => $idG)));
                    return;
                } else {
                    var_dump($code->getErrors());
                    var_dump($hint->getErrors());
                    return;
                }
            } else {
                var_dump($task->getErrors());
                return;
            }
        }

        $this->redirect(Yii::app()->createUrl('game/Tasks', array('idG' => $idG)));
    }

    // редактирование заданий
    public function actionEditTask($idTask, $idG)
    {
        if(isset($_POST['TaskCreateForm']))
        {
            $model = new TaskCreateForm;

            $model->attributes = $_POST['TaskCreateForm'];
            if ($model->validate()) {

                $task =  Task::model()->findAllByAttributes(array('IdGame'=>$idG, 'IdTask'=>$idTask));

                $task->NameTask = $model->taskname;
                $task->DescriptionTask = $model->task;

                if ($task->save()) {

                    $code = Code::model()->findAllByAttributes(array('IdTask' => $idTask));
                    $code->Cod = $model->code;

                    if ($code->save()) {
                    $this->redirect(Yii::app()->createUrl('game/Tasks', array('idG' => $idG)));
                    return;
                 }
                }
            }
        }
    }

  // редактирвоание игры
    public function actionEditGame($idGame)
    {
        $modelGame = new GameCreate;
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

        if(isset($_POST['Game']))
        {
             $modelGame-> attributes=$_POST['Game'];

            if($modelGame->validate())
            {
                $game->NameGame = $_POST['Game']['NameGame'];
                $game->DescriptionGame = $_POST['Game']['DescriptionGame'];
                $game->StartGame = $_POST['Game']['StartGame'];
                $game->FinishGame = $_POST['Game']['FinishGame'];
                $game->Comment = $_POST['Game']['Comment'];

                if($game->save()) {
                    $this->render('EditGame', array('Game' => $modelGame));
                    return;
                }
            }
        }

        $this->render('EditGame', array('Game'=>$modelGame));
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