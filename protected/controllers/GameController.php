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

        if(isset($_POST['ajax']) && $_POST['ajax']==='game-Create-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

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

        $game = Game::model()->findByAttributes(array('accepted' => '1'));

        if ($game == null) {
            echo "game don't accepted";
            return;
        }

        //получение времени
        $formatTime = $game->type;
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

        if (Yii::app()->user->isAdmin() || Yii::app()->user->isOrg()) {

            if ((int)$game->date < (int)$now) {
                if ($game->finish == 1) {
                    $this->finishPlay(); // после игры
                } else {
                    $this->nowPlay($game->id, $formatTime);// в игре
                }
            }else{//до игры
                $this->prePlay();
            }
        } else {
            $gameteam = Gameteam::model()->findByAttributes(array('gameId' => $game->id, 'teamId' => Yii::app()->user->id));

            if ((int)$game->date < (int)$now) {
                //финиш либо общий, либо для конкретной команды
                if ($game->finish == 1 || $gameteam->finish == 1) {
                    $this->finishPlay(); // после игры
                } else {
                    $this->nowPlay($game->id, $formatTime);// в игре
                }
            }else{//до игры
                $this->prePlay();
            }
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
            $this->render('NowPlayAdmin');

        }else{
            $gameteam = Gameteam::model()->findByAttributes(array('teamId' => Yii::app()->user->id, 'gameId' => $gameId));

            // сетка
            $criteria_grid = new CDbCriteria();
            $criteria_grid->alias = 'Grid';
            $criteria_grid->condition = 'gameId=' . $gameId . ' AND teamId=' . Yii::app()->user->id;
            //$criteria_grid->params = array(':gameId'=>$gameId, ':teamId'=>Yii::app()->user->id);
            $criteria_grid->order = 'orderTask ASC';

            $gridOrder = Grid::model()->findAll($criteria_grid);//порядок

            $a = array();
            $index = 0;

            //присваиваю номера заданиям
            foreach ($gridOrder as $grid) {
                $a[$index] = $grid;
                $index++;
            }

            $i = $a[$gameteam->counter]->orderTask;// порядковый номер задания

            $taskId = Grid::model()->findByAttributes(array('orderTask' => $i));// id задания

            $task = Task::model()->findByAttributes(array('id' => $taskId->taskId)); //задание
            $media_task = Media::model()->findByPk($task->mediaId);

            $hint = Hint::model()->findByAttributes(array('taskId' => $taskId->taskId)); //подсказки
            $media_hint = Media::model()->findByPk($hint->mediaId);

            $codes = null;

            $codes = Code::model()->findAllByAttributes(array('taskId'=>$taskId->taskId));
            if($codes != null) {
                $count_codes = count($codes);
            } else {
                $count_codes = 0;
            }

            //если что-то есть в окне для кода
            if(isset($_POST['codeUser'])){
                $code = Code::model()->findByAttributes(array('taskId' => $taskId->taskId, 'code'=>$_POST['codeUser'])); //код
                unset($_POST['codeUser']);

                //если это есть в таблице code
                if($code != null){

                    //смотрим, есть ли такое в codeteam, чтобы дважды не засчитать один код
                    $codeteam = Codeteam::model()->findByAttributes(array("codeId"=>$code->id));

                    //если что-то есть в код тим
                    if ($codeteam == null) {

                        $codeteam = new Codeteam();
                        $codeteam->teamId = Yii::app()->user->id;
                        $codeteam->codeId = $code->id;

                        if($codeteam->save()){

                            $codeteamforcount = Codeteam::model()->findAllByAttributes(array('teamId'=>$codeteam->teamId));

                            if($codeteamforcount != null) {
                                $count_codeteam = count($codeteamforcount);
                            }else{
                                $count_codeteam = 0;
                            }

                            //если все коды нашлись
                            if($count_codeteam == $count_codes){
                                //увеличиваем счетчик, все коды найдены
                                $gameteam->counter += 1;
                                Codeteam::model()->deleteAllByAttributes(array('teamId'=>$codeteam->teamId));
                                $gameteam->save();

                                $tasks = Task::model()->findAllByAttributes(array('gameId'=>$gameId));
                                if( $tasks != null ) {
                                    $count_tasks = count($tasks);
                                } else {
                                    $count_tasks = 0;
                                }

                                //если счетчик совпал с количеством заданий
                                if ($gameteam->counter == $count_tasks){
                                    //ставим финиш конкретной команде
                                    $gameteam->finish = 1;
                                    $gameteam->save();

                                    $this->checkFinishCondition($gameId);
                                    $this->redirect($this->createUrl('game/play'));
                                } else {
                                    $this->redirect($this->createUrl('game/play'));
                                }
                            }
                        }
                    }else{
                        //TODO: такой код есть
                        $codeteamforcount = Codeteam::model()->findAllByAttributes(array('teamId'=>$codeteam->teamId));

                        if($codeteamforcount != null) {
                            $count_codeteam = count($codeteamforcount);
                        }else{
                            $count_codeteam = 0;
                        }

                    }
                } else {
                    $codeteamforcount = Codeteam::model()->findAllByAttributes(array('teamId'=>Yii::app()->user->id));

                    if($codeteamforcount != null) {
                        $count_codeteam = count($codeteamforcount);
                    }else{
                        $count_codeteam = 0;
                    }
                }
            }else{
                $codeteamforcount = Codeteam::model()->findAllByAttributes(array('teamId'=>Yii::app()->user->id));

                if($codeteamforcount != null) {
                    $count_codeteam = count($codeteamforcount);
                }else{
                    $count_codeteam = 0;
                }
            }
            $this->render('NowPlayUser', array('task'=>$task,'media_task'=>$media_task, 'media_hint'=>$media_hint, 'hint' => $hint, 'count_codeteam'=>$count_codeteam, 'count_codes'=>$count_codes));
        }
    }

    private function checkFinishCondition($gameId){
        $gameteams = Gameteam::model()->findAllByAttributes(array('gameId'=>$gameId));
        foreach($gameteams as $gameteam){
            if($gameteam->finish != '1'){
                return;
            }
        }

        $game = Game::model()->findByPk($gameId);
        $game->finish = 1;
        $game->save();

    }

    public function finishPlay()
    {
        if (Yii::app()->user->isAdmin() || Yii::app()->user->isOrg()) {
            $this->render('FinishPlayAdmin');
        }else{
            $gameteam = Gameteam::model()->findByAttributes(array("teamId"=>Yii::app()->user->id));
            $this->render('FinishPlayUser', array('gameteam'=>$gameteam));
        }
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

                if(isset($taskList) && count($taskList) != 0) {
                    $mediaArray = array();

                    foreach ($taskList as $task) {
                        $mediaArray[$task->id] = Media::model()->findByPk($task->mediaId);
                    }
                } else {
                    $mediaArray = null;
                }

                // сетка
                $criteria_grid = new CDbCriteria();
                $criteria_grid->alias = 'Grid';
                $criteria_grid->condition = 'gameId='.$id;
                $criteria_grid->params = array(':gameId'=>$id);
                $criteria_grid->order= 'taskId ASC';

                $gridOrder = Grid::model()->findAll($criteria_grid);


                if(isset($_POST['GridForm'])) {
                    foreach($gridOrder as $gridItem){
                        if(isset($_POST['GridForm'][$gridItem->teamId . " : " . $gridItem->taskId])){
                            $gridItem->orderTask = $_POST['GridForm'][$gridItem->teamId . " : " . $gridItem->taskId];
                            if(!$gridItem->save()){
                                //ошибка
                                echo 'sdfs';
                            }
                        }
                    }
                }

                $this->render('PrePlayAdmin', array('gameAccept' => $gameAccept, 'teamList' => $teamList, 'taskList' => $taskList,'media'=>$mediaArray, 'gridOrder' => $gridOrder));
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

    //остановка игры
    public function actionStopGame(){
        $game = Game::model()->findByAttributes(array('accepted'=>'1'));

        //если вдруг последнее задание считается слитым и входит в сделанные - то раскоментить
        /*
        $gameteams = Gameteam::model()->findAllByAttributes(array("gameId"=>$game->id));


        foreach($gameteams as $gameteam){
            if($gameteam->finish != 1){
                $gameteam->counter += 1;
                $gameteam->save();
            }
        }
        */
        $game->finish = 1;
        if($game->save()) {
            $this->redirect(Yii::app()->createUrl('game/Play'));
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

        $tasks =  Task::model()->findAllByAttributes(array('gameId'=>$gameId));
        $gameEditModel = $this->getGameModeltoEditForm($gameId);
        //$gameEditModel->attributes=$_POST['GameCreate'];
        if(isset($_POST['ajax']) && $_POST['ajax']==='game-create-GameEdit-form')
        {
            echo CActiveForm::validate($gameEditModel);
            Yii::app()->end();
        }

        if(isset($tasks) && count($tasks) != 0) {
            $mediaArray = array();

            foreach ($tasks as $task) {
                $mediaArray[$task->id] = Media::model()->findByPk($task->mediaId);
            }
        } else {
            $mediaArray = null;
        }
        $this->render('Tasks',array('TaskCreate'=>$model, 'Task'=>$tasks,'media'=>$mediaArray,'gameEditModel'=>$gameEditModel, 'gameId'=>$gameId));
    }

   //Добавление одного задания
    public function actionTaskCreate($gameId)
    {
            $model = new TaskCreateForm;
        if (isset($_POST['TaskCreateForm'])) {
            $model->attributes = $_POST['TaskCreateForm'];
            $game= Game::model()->findByAttributes(array('id'=>$gameId));
            $model->type = $game->type;
            $task = new Task;
            $media = new Media;

            if(isset($_POST['ajax']) && $_POST['ajax']==='task-create-form-TaskCreate-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if ($model->validate()) {

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
        $task = Task::model()->findByPk($taskId);
        $media_task = Media::model()->findByPk($task->mediaId);
        $code = Code::model()->findByAttributes(array('taskId'=>$taskId));
        $hint = Hint::model()->findByAttributes(array('taskId'=>$taskId));
        $media_hint = Media::model()->findByPk($hint->mediaId);

        if($task == null){
            echo 'Ошибка';
            return;
        }

        $model = new TaskCreateForm;
        //записать данные которые есть сейчас
        $model->taskname=$task->name;
        $model->task=$media_task->description;
        $model->code=$code->code;
        $model->tip=$media_hint->description;
        $model->type=$task->type;
        $model->address=$task->address;

        //если POST не пустой
        if(isset($_POST['TaskCreateForm']))
        {
            $model->attributes = $_POST['TaskCreateForm'];

            if(isset($_POST['ajax']) && $_POST['ajax']==='task-create-form-TaskEdit-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
                 // если прошла валидация
            if ($model->validate())
            {
                //записать изменения
                $task->name = $_POST['TaskCreateForm']['taskname'];
                $media_task->description = $_POST['TaskCreateForm']['task'];
                $media_hint->description= $_POST['TaskCreateForm']['tip'];
                $code->code=$_POST['TaskCreateForm']['code'];
                $task->type=$_POST['TaskCreateForm']['type'];
                $task->address = $_POST['TaskCreateForm']['address'];

                if ($task->save() && $code->save() && $hint->save() && $media_task->save() && $media_hint->save())
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