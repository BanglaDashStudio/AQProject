<?php

class GameController extends Controller
{

    // создание игры
	public function actionCreate()
    {
        $model = new GameCreate;
        $model->start='22:00:00';
        $model->type='15-15-15';
        if (isset($_POST['GameCreate'])) {

            $model->attributes = $_POST['GameCreate'];
            if ($model->validate()) {

                $game = new Game;

                $game->name=$model->name;
                $game->description=$model->description;
                $game->start=$model->start;
                $game->date=$model->date;
                $game->type=$model->type;
                $game->comment=$model->comment;
                $game->teamId = Yii::app()->user->id;

                if ($game->save()) {
                    $this->redirect(Yii::app()->createUrl('game/Tasks', array('idG' =>$game->id)));
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
        $gameAccept=Game::model()->findByAttributes(array('accepted'=>'1'));

        $criteria = new CDbCriteria();

        if (!isset($gameAccept)) {
            $this->render('Play', array('model'=>NULL,'teamList'=>NULL, 'taskList'=>NULL, 'gridOrder'=>NULL));
        } else {
            $criteria->condition = $this->getGameTeam($gameAccept->id);

            if (isset($criteria->condition)) {
                $teamList = Team::model()->findAll($criteria);
            }else {
                $teamList = null;
            }

            // id игры
            $id = $gameAccept->id;

            // поиск заданий для игры
            $criteria_task = new CDbCriteria();
            $criteria_task->alias = 'Task';
            $criteria_task->condition = 'gameId='.$id;
            $criteria_task->params = array(':gameId'=>$id);

            $taskList = Task::model()->findAll($criteria_task);

            // сетка
            $criteria_grid = new CDbCriteria();
            $criteria_grid->alias = 'Grid';
            $criteria_grid->condition = 'gameId='.$id;
            $criteria_grid->params = array(':gameId'=>$id);
            $criteria_grid->order= 'taskId ASC';

            $gridOrder = Grid::model()->findAll($criteria_grid);

            $this->render('Play', array('gameAccept' => $gameAccept, 'teamList' => $teamList, 'taskList' => $taskList, 'gridOrder' => $gridOrder));
        }
    }

    private function getGameTeam ($id) {
        $teams = Gameteam::model()->findAllByAttributes(array('gameId'=>$id));
        $condition = "";
        if(isset($teams)){
            $first = true;
            foreach ($teams as $team) {
                if ($first) {
                    $condition = "id=".$team->id;
                    $first = false;
                } else {
                    $condition .= " or id=".$team->id;
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

    public function actionNewOrder($gameId, $teamId)
    {
        $newOrder = new Gameteam;
        $newOrder->teamId = $teamId;
        $newOrder->gameId = $gameId;
        if ($newOrder->save()) {
            $this->redirect(Yii::app()->createUrl('game/Play'));
        }
    }

    public function actionDeleteOrder($IdGame, $IdTeam)
    {
        Gameteam::model()->deleteAllByAttributes(array('gameId'=>$IdGame,'teamId'=>$IdTeam));
        $this->redirect(Yii::app()->createUrl('game/Play'));
    }

    //список игр 1 команды
    public function actionMyGames()
    {
        $gameList=Game::model()->findAllByAttributes(array('teamId'=>Yii::app()->user->id));
        $this->render('MyGames', array('model'=>$gameList));
    }

    // для ссылок на игры
    public function actionListGame($idGame)
    {
        $game = Game::model()->findById($idGame);
        $this->render('MyGames', array('model'=>$game->name));
    }

    // добавление заданий
    public function actionTasks($idG)
    {
        if (!isset($idG))
            return;

        $model = new TaskCreateForm;
        $task =  Task::model()->findAllByAttributes(array('gameId'=>$idG));
        $this->render('Tasks',array('TaskCreate'=>$model, 'Task' => $task, 'idG'=>$idG));
    }

   //Добавление одного задания
    public function actionTaskCreate($idG)
    {
        if (isset($_POST['TaskCreateForm'])) {
            $model = new TaskCreateForm;

            $game= Game::model()->findByAttributes(array('id'=>$idG));
            $model->type = $game->type;
            //$model->attributes = $_POST['TaskCreateForm'];

            $task = new Task;

            $task->gameId = $idG;
            $task->name = $_POST['TaskCreateForm']['taskname'];
            $task->description = $_POST['TaskCreateForm']['task'];
            $task->address = $_POST['TaskCreateForm']['address'];
            $task->type = $_POST['TaskCreateForm']['type'];

            //$task->DescriptionTask = $model->task;

            if ($task->save()) {
                $code = new Code;
                $hint = new Hint;

                $code->code = $_POST['TaskCreateForm']['code'];
                $code->taskId = $task->id;

                $hint->description = $_POST['TaskCreateForm']['tip'];
                $hint->taskId = $task->id;

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
        $task = Task::model()->findByAttributes(array('id'=>$IdTask));
        $code = Code::model()->findByAttributes(array('taskId'=>$IdTask));
        $hint = Hint::model()->findByAttributes(array('taskId'=>$IdTask));
        

        if($task == null){
            echo 'Ошибка';
            return;
        }

        $model = new TaskCreateForm;
        //записать данные которые есть сейчас
        $model->taskname=$task->name;
        $model->task=$task->description;
        $model->code=$code->code;
        $model->tip=$hint->description;
        $model->type=$task->type;
        $model->address=$task->address;

        //если POST не пустой
        if(isset($_POST['TaskCreateForm']))
        {
           // $model->attributes = $_POST['TaskEditForm'];
                 // если прошла валидация
            if ($model->validate())
            {
                //записать изменения
                $task->name = $_POST['TaskCreateForm']['taskname'];
                $task->description = $_POST['TaskCreateForm']['task'];
                $hint->description= $_POST['TaskCreateForm']['tip'];
                $code->code=$_POST['TaskCreateForm']['code'];
                $task->type=$_POST['TaskCreateForm']['type'];
                $task->address = $_POST['TaskCreateForm']['address'];

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
        $game = Game::model()->findByAttributes(array('id'=>$idG));

        if($game == null){
            echo 'Ошибка';
            return;
        }
        $model = new GameCreate;

        $model->name=$game->name;
        $model->description=$game->description;
        $model->start=$game->start;
        $model->type=$game->type;
        $model->date=$game->date;
        $model->comment=$game->comment;

        if(isset($_POST['GameCreate']))
        {
            $model->attributes = $_POST['GameCreate'];

            if ($model->validate())
            {
                $game->name = $_POST['GameCreate']['name'];
                $game->description = $_POST['GameCreate']['description'];
                $game->start= $_POST['GameCreate']['start'];
                $game->type= $_POST['GameCreate']['type'];
                $game->date=$_POST['GameCreate']['date'];
                $game->comment= $_POST['GameCreate']['comment'];

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