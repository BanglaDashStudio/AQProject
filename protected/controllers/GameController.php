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

        if ($gameList->save())
        {
            $gameteam = new Gameteam;
            $gameteam->IdTeam = Yii::app()->user->id;
            $gameteam->IdGame = $gameList->IdGame;
            $this->render('Play', array('model'=>$gameList));
        }
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

            $task = new Task;
            $task->IdGame = $idG;

            $task->NameTask = $_POST['TaskCreateForm']['taskname'];
            $task->DescriptionTask = $_POST['TaskCreateForm']['task'];

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
    public function actionEditTask($IdTask, $idG)
    {

        $model = new TaskCreateForm;

        //получение задания, кода и подсказки по id задания
        $task =  Task::model()->findAllByAttributes(array('IdTask'=>$IdTask));
        $code =  Code::model()->findAllByAttributes(array('IdTask'=>$IdTask));
        $hint =  Hint::model()->findAllByAttributes(array('IdTask'=>$IdTask));

        // заполнение формы для задания
        $model->taskname= $task->NameTask;
        $model->task = $task->DescriptionTask;
        $model->code = $code->Cod;
        $model->tip = $hint->DescriptionHint;

        if(isset($_POST['TaskEditForm']))
        {
            $model->attributes = $_POST['TaskEditForm'];

            if ($model->validate()) {

                //записать имя задания
                $task->NameTask = $_POST['TaskEditForm']['taskname'];
                //записать задание
                $task->DescriptionTask = $_POST['TaskEditForm']['task'];

                //записать код
                $code->Cod = $_POST['TaskEditForm']['code'];
                //записать подсказку
                $hint->DescriptionHint = $_POST['TaskEditForm']['tip'];

                if ($code->save() && $task->save() && $hint->save())
                {
                    //если всё сохранилось обратно на страницу со список заданий к игре
                    $this->redirect(Yii::app()->createUrl('game/Tasks', array('idG' => $idG)));
                    return;
                }
            }
        }
            //отображать view для редактирования
        $this->render('TaskEdit',array('model'=>$model, 'idG' => $idG));
    }
}