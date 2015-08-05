<?php

class TestController extends Controller
{
 //проверка 


    public function actionIndex() {
        $this->render('upload');
    }

    public function actionUpload($mediaId){
        $this->render('upload',array('mediaId'=>$mediaId));
    }

    //1
    public function actionCreateTask($gameId){
        $this->render('createTask',array('gameId'=>$gameId,'taskCreateForm'=>new TaskCreateForm));
    }

    //2
    public function actionSaveTask($gameId){
        var_dump($_POST);


        if(isset($_POST['task'])) {

            if(!isset($_POST['task']['id']) || $_POST['task']['id'] == "") {
                $task = new Task();
            } else {
                $task = Task::model()->findByPk($_POST['task']['id']);
            }

            $task->gameId = $gameId;

            if(isset($_POST['task']['address'])){
                $task->address = $_POST['task']['address'];
            }

            if(isset($_POST['task']['name'])){
                $task->name = $_POST['task']['name'];
            }

            if($task->validate()){

                if(!isset($task->mediaId)){
                    $media_task = new Media();
                    $task->mediaId = $media_task;

                } else {
                    $media_task = Media::model()->findByPk($task->mediaId);
                }

                $task->save();

                $media_task->description = $_POST['task']['description'];

                if($media_task->validate()){
                    $media_task->save();

                    $codes = null;
                    $hints = null;

                    if(isset($_POST['task']['hint']) && isset($_POST['hint_amount'])){
                        if($_POST['hint_amount'] != 0){
                            $hints = $this->readHints($_POST['task']['hint'],$_POST['hint_amount'], $task);
                        }
                    }

                    if(isset($_POST['task']['code']) && isset($_POST['code_amount'])){
                        $codes = $this->readCodes($_POST['task']['code'],$_POST['code_amount'], $task);
                    } else {
                        $this->render('task',array('gameId'=>$gameId));
                        return;
                    }

                    $this->render('task',array('gameId'=>$gameId,'task'=>$task,'codes'=>$codes,'hints'=>$hints, 'media_task'=>$media_task));
                    return;
                }
            } else {
                echo 'Плохо';
            }
        }

        $this->render('task',array('gameId'=>$gameId));
    }

    private function readCodes($codeArray, $codeAmount,$task){
        if($task != null) {
            $codes = array();

            for ($i = 0; $i < $codeAmount; $i++) {
                if (isset($codeArray[$i])) {
                    $code = new Code;
                    $code->taskId = $task->id;
                    $code->code = $codeArray[$i];
                    if($code->validate()) {
                        $code->save();
                    }
                    $codes[$i] = $code;
                }
            }
            return $codes;
        }
    }

    private function readHints($hintArray, $hintAmount,$task){
        if($task != null) {
            $hints = array();

            for ($i = 0; $i < $hintAmount; $i++) {
                if (isset($hintArray[$i])) {
                    $hint = new Hint;
                    $hint_media = new Media();
                    $hint->taskId = $task->id;
                    $hint_media->description = $hintArray[$i];

                    $hint_media->save();
                    $hint->mediaId = $hint_media->id;

                    $hint->save();

                    $hints[$i] = $hint;
                }
            }
            return $hints;
        }
    }

    public function actionCreateTaskTest($gameId)
    {
        $taskForm = new TaskCreate;

        $taskForm->type = '15-15-15';

        if(isset($_POST['ajax']) && $_POST['ajax']==='task-create-createTaskForm-form')
        {
            echo CActiveForm::validate($taskForm);
            Yii::app()->end();
        }

        if(isset($_POST['TaskCreate']))
        {
            $taskForm->name = $_POST['TaskCreate']['name'];
            $taskForm->address = $_POST['TaskCreate']['address'];
            $taskForm->type = $_POST['TaskCreate']['type'];
            $taskForm->description = $_POST['TaskCreate']['description'];
            $taskForm->code = $_POST['TaskCreate']['code'];

            if($taskForm->validate())
            {
                if(null == Task::model()->findAllByAttributes(array('name'=>$taskForm->name,
                        'address'=>$taskForm->address)) ){
                    $task = new Task();
                } else {
                    $task = Task::model()->findByAttributes(array('name'=>$taskForm->name,
                        'address'=>$taskForm->address));
                }

                $task->name = $taskForm->name;
                $task->address = $taskForm->address;
                $task->type = $taskForm->type;
                $task->gameId = $gameId;


                if(!isset($task->mediaId)){
                    $media = new Media();
                } else {
                    $media = Media::model()->findByPk($task->mediaId);
                }

                $media->description = $taskForm->description;

                if($media->save()) {
                    $task->mediaId = $media->id;
                } else {
                    return;
                }

                if(!$task->save()) {
                    Media::model()->deleteByPk($media->id);
                    return;
                }

                Code::model()->deleteAllByAttributes(array('taskId'=>$task->id));

                $code = new Code();

                $code->taskId = $task->id;
                $code->code = $taskForm->code;

                if(!$code->save()){
                    Media::model()->deleteByPk($media->id);
                    Task::model()->deleteByPk($task->id);
                    return;
                }

                if(isset($_POST['TaskCreate']['codes'])){
                    foreach($_POST['TaskCreate']['codes'] as $item){
                        if($item != ''){
                            $code = new Code();
                            $code->taskId = $task->id;
                            $code->code = $item;

                            if(null == Code::model()->findByAttributes(array('taskId'=>$code->taskId,
                                                                        'code'=>$code->code)))
                            {
                                if($code->validate()){
                                    $code->save();
                                }
                            }
                        }
                    }
                }

                if(isset($_POST['TaskCreate']['codes'])) {
                    $this->render('updateTaskForm', array('mediaId'=>$task->mediaId,'gameId' => $gameId, 'createTaskForm' => $taskForm, 'codes' => $_POST['TaskCreate']['codes']));
                } else {
                    $this->render('updateTaskForm', array('mediaId'=>$task->mediaId, 'gameId' => $gameId, 'createTaskForm' => $taskForm));
                }
                return;
            }
        }
        $this->render('createTaskForm',array('gameId'=>$gameId, 'createTaskForm'=>$taskForm));
    }

    public function actionUploadImage($mediaId) {

        if(isset($_FILES['uploadImage'])){
            $uploaddir = 'data/images/';
            $uploadfile = $uploaddir . $_FILES['uploadImage']['name'];

            if(is_uploaded_file($_FILES["uploadImage"]["tmp_name"])) {
                if (move_uploaded_file(($_FILES['uploadImage']['tmp_name']), $uploadfile)) {
                    $link = $uploadfile;

                    $media = Media::model()->findByPk($mediaId);
                    if($media == null) {
                        echo 'Невозможно прикрепить изображение к заданию';
                        return;
                    }
                    $media->image = $link;

                    if(!$media->save()){
                        echo 'Ошибка добавления ссылки в бд';
                        return;
                    } else {
                        $this->render('uploadImage',array('mediaId'=>$mediaId));
                    }
                }else {
                    echo "Ошибка перемещения аудио!\n";
                    return;
                }
            } else {
                echo "Ошибка загрузки аудио!\n";
                return;
            }
        } else {
            $this->render('uploadImage',array('mediaId'=>$mediaId));
        }
    }

    public function actionUploadAudio() {
        $uploaddir = 'data/audio/';
        $uploadfile = $uploaddir . $_FILES['uploadAudio']['name'];

        if (move_uploaded_file(($_FILES['uploadAudio']['tmp_name']), $uploadfile)) {
            $link = $uploadfile;

            $media = new Media();
            $media->audio = $link;

            if(!$media->save()){
                echo 'Ошибка добавления ссылки в бд';
            } else {
                echo 'все хорошо';
            }

        } else {
            echo "Ошибка загрузки аудио!\n";
        }
    }


    public function addCodes(){
    }

    public function actionMedia(){
        $this->render('_media',array('media'=>Media::model()->findByPk(17)));
    }

    public function actionVideo() {
        $this->render('video');
    }

    public function actionEcho(){
        echo 'Nya!';
    }

    public function actionTimer(){
        $this->render('timer');
    }

    public function actionTimerRequest(){
        echo 1438398987;
        return;
    }
}
