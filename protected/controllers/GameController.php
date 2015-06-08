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
        $gameList=Game::model()->findAllByAttributes(array('AcceptGame'=>'1')) ;
		$this->render('Play', array('model'=>$gameList));
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

        if (isset($_POST['TaskCreateForm'])) {
            $model = new TaskCreateForm;

            $model->attributes = $_POST['TaskCreateForm'];
            if ($model->validate()) {

                $task = new Task;

                $task->IdGame = $idG;
                $task->NameTask = $model->taskname;
                $task->DescriptionTask = $model->task;

                if ($task->save()) {

                    $code = new Code;
                    $hint = new Hint;

                    $code->Cod = $model->code;
                    $code->IdTask = $task->IdTask;

                    $hint->DescriptionHint = $model->tip;
                    $hint->IdTask = $task->IdTask;

                    if ($code->save() && $hint->save()) {

                        $this->redirect(Yii::app()->createUrl('game/Tasks', array('idG' => $idG)));
                        return;
                    }
                }

            }else {
                $this->redirect(Yii::app()->createUrl('game/Tasks', array('idG' => $idG)));
                return;
            }
        }$this->redirect(Yii::app()->createUrl('game/Tasks', array('idG' => $idG)));
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