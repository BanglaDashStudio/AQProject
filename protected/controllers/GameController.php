<?php

class GameController extends Controller
{
    public function actiontest(){

        $gameAccept=Game::model()->findByAttributes(array('accepted'=>'1'));

        $criteria = new CDbCriteria();

        if (!isset($gameAccept)) {
            $this->render('PrePlayAdmin', array('gameAccept'=>NULL,'teamList'=>NULL, 'taskList'=>NULL, 'gridOrder'=>NULL));
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

            $this->render('PrePlayAdmin', array('gameAccept' => $gameAccept, 'teamList' => $teamList, 'taskList' => $taskList, 'gridOrder' => $gridOrder));
        }
    }

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
                $game->date=strtotime($model->date)+$this->getTime($model->start);
                $game->type=$model->type;
                $game->comment=$model->comment;
                $game->teamId = Yii::app()->user->id;

                if ($game->save()) {
                    $this->redirect(Yii::app()->createUrl('game/Tasks', array('gameId' =>$game->id)));
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

       $game = Game::model()->findByAttributes(array('accepted'=>'1'));
        if($game == null) {
            echo "game don't accepted";
            return;
        }

        //получение времени
        $formatTime=$game->type;
        /*
        $a=" 00:00:00";
        $b=date("Y-m-d");
        //след. день
        $day= date("d")+1;
        $da= date("Y-m-");

        $c = $b.$a; //СЕГОДНЯ
        $c1 =$da.$day.$a;// ЗАВТРА

            if ( ($game->date == $c || $game->date == $c1) && $game->start <= date("H:i:s")) {
        */

        $now = time();

        if((int)$game->date < (int)$now){
                if ($game->finish == 1) {
                    $this->finishPlay(); // после игры
                }else {
                    $this->nowPlay($game->id, $formatTime);// в игре
                }
        }else{//до игры
            $this->prePlay();
        }
    }

    private function getTime($time){
        $str_time = $time;
        $hours=0;
        $minutes=0;
        $seconds=0;
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        return isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
    }

    public function nowPlay($gameId, $formatTime)
    {
        //время
        list($hintTime, $addressTime, $fullTime) = explode('-', $formatTime);

        if (Yii::app()->user->isAdmin() || Yii::app()->user->isOrg()) {
            echo 'view for admin';
            return;
        }else{
            $user = Gameteam::model()->findByAttributes(array('teamId' => Yii::app()->user->id, 'gameId' => $gameId));

            // сетка
            $criteria_grid = new CDbCriteria();
            $criteria_grid->alias = 'Grid';
            $criteria_grid->condition = 'gameId=' . $gameId . ' AND teamId=' . Yii::app()->user->id;
            //$criteria_grid->params = array(':gameId'=>$gameId, ':teamId'=>Yii::app()->user->id);
            $criteria_grid->order = 'orderTask ASC';

            $gridOrder = Grid::model()->findAll($criteria_grid);//порядок

            $a = array();
            $ddd = 0;
            foreach ($gridOrder as $grid) {
                $a[$ddd] = $grid;
                $ddd++;
            }


            // foreach ($gridOrder as $grid) {

            $i = $a[0]->orderTask;// порядковый номер задания

            $taskId = Grid::model()->findByAttributes(array('orderTask' => $i));// id задания
            $task = Task::model()->findByAttributes(array('id' => $taskId->taskId)); //задание

            $hint = Hint::model()->findByAttributes(array('taskId' => $taskId->taskId)); //подсказка

            $code = Code::model()->findByAttributes(array('taskId' => $taskId->taskId)); //код


            $this->render('NowPlayUser', array('task' => $task, 'hint' => $hint, 'code' => $code));
            //}
        }
    }

    public function finishPlay()
    {
        echo "finish";

    }

    private function prePlay(){
        if (Yii::app()->user->isAdmin() || Yii::app()->user->isOrg()){

            $gameAccept = Game::model()->findByAttributes(array('accepted'=>'1'));

            $criteria = new CDbCriteria();

            if (!isset($gameAccept)) {

                $this->render('PrePlayAdmin', array('gameAccept'=>NULL,'teamList'=>NULL, 'taskList'=>NULL, 'gridOrder'=>NULL));

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

                $this->render('PrePlayAdmin', array('gameAccept' => $gameAccept, 'teamList' => $teamList, 'taskList' => $taskList, 'gridOrder' => $gridOrder));
            }

        }else{

            $gameAccept=Game::model()->findByAttributes(array('accepted'=>'1'));

            $criteria = new CDbCriteria();

            if (!isset($gameAccept)) {
                $this->render('PrePlayUser', array('gameAccept'=>NULL,'teamList'=>NULL, 'taskList'=>NULL, 'gridOrder'=>NULL));
            } else {
                $criteria->condition = $this->getGameTeam($gameAccept->id);

                if (isset($criteria->condition)) {
                    $teamList = Team::model()->findAll($criteria);
                }else {
                    $teamList = null;
                }

                $this->render('PrePlayUser', array('gameAccept' => $gameAccept, 'teamList' => $teamList));
            }

        }
    }

    private function getGameTeam ($id) {
        $gameForTeams = Gameteam::model()->findAllByAttributes(array('gameId'=>$id));
        $condition = "";
        if(isset($gameForTeams)){
            $first = true;
            foreach ($gameForTeams as $gameForTeamItem) {
                if ($first) {
                    $condition = "id=".$gameForTeamItem->teamId;
                    $first = false;
                } else {
                    $condition .= " or id=".$gameForTeamItem->teamId;
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
        $game = Game::model()->findByPk($gameId);
        if(isset($game)) if($game->orderLock == 0) return;

        $newOrder = Gameteam::model()->findByAttributes(array('teamId'=>$teamId,'gameId'=>$gameId));

        if($newOrder != null) {
            Gameteam::model()->deleteAllByAttributes(array('teamId'=>$teamId,'gameId'=>$gameId));
        }

        $newOrder = new Gameteam();
        $newOrder->teamId = $teamId;
        $newOrder->gameId = $gameId;

        if ($newOrder->save()) {
            $this->redirect(Yii::app()->createUrl('game/Play'));
        } else {
            echo 'что-то не так';
        }
    }

    public function actionDeleteOrder($gameId, $teamId)
    {
        $game = Game::model()->findByPk($gameId);
        if(isset($game)) if($game->orderLock == 0) return;

        Grid::model()->deleteAllByAttributes(array('gameId'=>$gameId,'teamId'=>$teamId));
        Gameteam::model()->deleteAllByAttributes(array('gameId'=>$gameId,'teamId'=>$teamId));

        $this->redirect(Yii::app()->createUrl('game/Play'));
    }

    //список игр 1 команды
    public function actionMyGames()
    {
        $gameList=Game::model()->findAllByAttributes(array('teamId'=>Yii::app()->user->id));
        $this->render('MyGames', array('model'=>$gameList));
    }

    // для ссылок на игры
    public function actionListGame($gameId)
    {
        $game = Game::model()->findById($gameId);
        $this->render('MyGames', array('model'=>$game->name));
    }

    // добавление заданий
    public function actionTasks($gameId)
    {
        if (!isset($gameId))
            return;

        if(isset($_POST['GameCreate'])) {
            $this->editGameById($gameId, $_POST['GameCreate']);
        }

        $model = new TaskCreateForm;
        $task =  Task::model()->findAllByAttributes(array('gameId'=>$gameId));
        $gameEditModel = $this->getGameModeltoEditForm($gameId);

        $this->render('Tasks',array('TaskCreate'=>$model, 'Task'=>$task,'gameEditModel'=>$gameEditModel, 'gameId'=>$gameId));
    }

   //Добавление одного задания
    public function actionTaskCreate($gameId)
    {
        if (isset($_POST['TaskCreateForm'])) {
            $model = new TaskCreateForm;
            $game= Game::model()->findByAttributes(array('id'=>$gameId));
            $model->type = $game->type;
            //$model->attributes = $_POST['TaskCreateForm'];

            $task = new Task;
            $media = new Media;

            $task->gameId = $gameId;
            $task->name = $_POST['TaskCreateForm']['taskname'];
            $media->description = $_POST['TaskCreateForm']['task'];
            $task->address = $_POST['TaskCreateForm']['address'];
            $task->type = $_POST['TaskCreateForm']['type'];

            //$task->DescriptionTask = $model->task;
            if(!$media->save()){
                echo "media not save";
                return;
            }else{
                $task->mediaId = $media->id;
            }

            if ($task->save()) {
                $code = new Code;
                $hint = new Hint;
                $mediahint = new Media;

                $code->code = $_POST['TaskCreateForm']['code'];
                $code->taskId = $task->id;

                $mediahint->description = $_POST['TaskCreateForm']['tip'];
                $hint->taskId = $task->id;

                if(!$mediahint->save()){
                    echo "media not save";
                    return;
                }else{
                    $hint->mediaId = $mediahint->id;
                }

                if ($code->save() && $hint->save()) {
                    $this->redirect(Yii::app()->createUrl('game/Tasks', array('gameId' => $gameId)));
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

        $this->redirect(Yii::app()->createUrl('game/Tasks', array('gameId' => $gameId)));
    }

    public function actionDeleteTask($taskId, $gameId)
    {
        $hints = Hint::model()->findAllByAttributes(array('taskId'=>$taskId));
        foreach($hints as $hint){
            Media::model()->deleteByPk($hint->mediaId);
        }
        Hint::model()->deleteAllByAttributes(array('taskId'=>$taskId));
        Code::model()->deleteAllByAttributes(array('taskId'=>$taskId));
        Grid::model()->deleteAllByAttributes(array('taskId'=>$taskId));

        $task = Task::model()->findByPk($taskId);
        Media::model()->deleteByPk($task->mediaId);
        Task::model()->deleteByPk($taskId);

        $this->redirect($this->createUrl('game/Tasks',array('gameId'=>$gameId)));
    }

    public function actionDeleteGame($gameId)
    {
        $tasks = Task::model()->findAllByAttributes(array('gameId'=>$gameId));

        Gameteam::model()->deleteAllByAttributes(array('gameId'=>$gameId));

        foreach($tasks as $task) {
            $hints = Hint::model()->findAllByAttributes(array('taskId'=>$task->id));
            foreach($hints as $hint){
                Media::model()->deleteByPk($hint->mediaId);
            }
            Hint::model()->deleteAllByAttributes(array('taskId' => $task->id));
            Code::model()->deleteAllByAttributes(array('taskId' => $task->id));
            Grid::model()->deleteAllByAttributes(array('taskId' => $task->id));

            $task_1 = Task::model()->findByPk($task->id);
            Media::model()->deleteByPk($task_1->mediaId);
            Task::model()->deleteByPk($task->id);
        }

        Game::model()->deleteByPk($gameId);

        $this->redirect($this->createUrl('game/MyGames'));
    }

    // редактирование заданий
    public function actionTaskEdit($taskId, $gameId)
    {

       //найти задание, код и подсказку по id задания
        $task = Task::model()->findByAttributes(array('id'=>$taskId));
        $code = Code::model()->findByAttributes(array('taskId'=>$taskId));
        $hint = Hint::model()->findByAttributes(array('taskId'=>$taskId));
        

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
                    $this->redirect(Yii::app()->createUrl('game/Tasks', array('gameId' => $gameId)));
                    return;
                 }
            }
        }
        $this->render('TaskEdit',array('model'=>$model,'gameId' => $gameId));
    }

    private function getGameModeltoEditForm($gameId)
    {
        $game = Game::model()->findByAttributes(array('id'=>$gameId));

        if($game == null){
            echo 'Ошибка';
            return;
        }

        $gameCreateModel = new GameCreate;

        $gameCreateModel->name=$game->name;
        $gameCreateModel->description=$game->description;
        $gameCreateModel->start=date('H:i:s',$game->date);
        $gameCreateModel->type=$game->type;
        $gameCreateModel->date = date('Y-m-d',$game->date);
        $gameCreateModel->comment=$game->comment;

        return $gameCreateModel;
    }

    private function editGameById($gameId, $post)
    {
        $game = Game::model()->findByAttributes(array('id'=>$gameId));
        $game->name = $post['name'];
        $game->description = $post['description'];
         //$post['start'];
        $game->type = $post['type'];
        $game->date = strtotime($post['date'])+$this->getTime($post['start']);
        $game->comment = $post['comment'];

        if ($game->validate())
        {
            $game->save();
        }

    }

    public function actionUnlockOrder($gameId) {
        $game = Game::model()->findByPk($gameId);

        if(!isset($game)){
            return;
        }

        $game->orderLock = 1;

        $game->save();

        $this->redirect($this->createUrl('game/Play'));
    }

    public function actionLockOrder($gameId) {
        $game = Game::model()->findByPk($gameId);

        if(!isset($game)){
            return;
        }

        $game->orderLock = 0;

        $game->save();

        $this->redirect($this->createUrl('game/Play'));
    }
}