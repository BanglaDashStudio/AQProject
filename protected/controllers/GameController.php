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
            $this->render('Play', array('model'=>NULL,'teamList'=>NULL, 'taskList'=>NULL));
        } else {
            $criteria->condition = $this->getGameTeam($gameAccept->IdGame);

            if (isset($criteria->condition)) {
                $teamList = Team::model()->findAll($criteria);
            }else {
                $teamList = null;
            }

            $id= $gameAccept->IdGame;
              $taskList = Task::model()->findAllByAttributes(array('IdGame'=>$id));

            $this->render('Play', array('model' => $gameAccept, 'teamList' => $teamList, 'taskList' => $taskList));
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
    public function actionTaskEdit($IdTask, $idG)
    {
       //найти задание, код и подсказку по id задания
        $task = Task::model()->findByAttributes(array('IdTask'=>$IdTask));
        $code = Code::model()->findByAttributes(array('IdTask'=>$IdTask));
        $hint = Hint::model()->findByAttributes(array('IdTask'=>$IdTask));

        if($task == null){
            echo 'Ошибка';
            return;
        }

        $model = new TaskCreateForm;
        //записать данные которые есть сейчас
        $model->taskname=$task->NameTask;
        $model->task=$task->DescriptionTask;
        $model->code=$code->Cod;
        $model->tip=$hint->DescriptionHint;

       // var_dump($_POST);
        //return;

        //если POST не пустой
        if(isset($_POST['TaskCreateForm']))
        {
           // $model->attributes = $_POST['TaskEditForm'];
                 // если прошла валидация
            if ($model->validate())
            {
                //записать изменения
                $task->NameTask = $_POST['TaskCreateForm']['taskname'];
                $task->DescriptionTask = $_POST['TaskCreateForm']['task'];
                $hint->DescriptionHint= $_POST['TaskCreateForm']['tip'];
                $code->Cod=$_POST['TaskCreateForm']['code'];

                if ($task->save() && $code->save() && $hint->save())
                {
                    // если всё сохранилось, открыть список заданий этой игры
                    $this->redirect(Yii::app()->createUrl('game/Tasks', array('idG' => $idG)));
                    return;
                 }
            }
        }
        $this->render('TaskEdit',array('model'=>$model,'idG' => $idG));
    }

    // редактирование информации об игре
    public function actionGameEdit($idG)
    {
        $game = Game::model()->findByAttributes(array('IdGame'=>$idG));

        if($game == null){
            echo 'Ошибка';
            return;
        }
        $model = new GameCreate;

        $model->NameGame=$game->NameGame;
        $model->DescriptionGame=$game->DescriptionGame;
        $model->StartGame=$game->StartGame;
        $model->FinishGame=$game->FinishGame;
        $model->Date=$game->Date;
        $model->Comment=$game->Comment;

        if(isset($_POST['GameCreate']))
        {
            $model->attributes = $_POST['GameCreate'];

            if ($model->validate())
            {
                $game->NameGame = $_POST['GameCreate']['NameGame'];
                $game->DescriptionGame = $_POST['GameCreate']['DescriptionGame'];
                $game->StartGame= $_POST['GameCreate']['StartGame'];
                $game->FinishGame= $_POST['GameCreate']['FinishGame'];
                $game->Date=$_POST['GameCreate']['Date'];
                $game->Comment= $_POST['GameCreate']['Comment'];

                if ($game->save())
                {
                    $this->redirect(Yii::app()->createUrl('game/MyGames'));
                    return;
                }
            }
        }

        $this->render('GameEdit',array('model'=>$model,'idG' => $idG));
    }
}