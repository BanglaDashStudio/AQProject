<?php

class TestController extends Controller
{

    public function actionUploadImage() {

        $uploaddir = 'data/images/';
        $uploadfile = $uploaddir . $_FILES['uploadImage']['name'];

        if (move_uploaded_file(($_FILES['uploadImage']['tmp_name']), $uploadfile)) {
            $link = $uploadfile;

            $media = new Media();
            $media->image = $link;

            if(!$media->save()){
                echo 'Ошибка добавления ссылки в бд';
            } else {
                echo 'все хорошо';
            }

        } else {
            echo "Ошибка загрузки аудио!\n";
        }

    }

    public function actionUploadAudio() {
        $uploaddir = 'data/audio/';
        $uploadfile = $uploaddir . $_FILES['uploadImage']['name'];

        if (move_uploaded_file(($_FILES['uploadImage']['tmp_name']), $uploadfile)) {
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

    public function actionIndex() {
        $this->render('upload');
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

    public function actionCreateTaskForm()
    {
        $model = new TaskCreate;

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='task-create-createTaskForm-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['TaskCreate']))
        {
            $model->attributes=$_POST['TaskCreate'];
            if($model->validate())
            {
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('createTaskForm',array('model'=>$model));
    }


    public function addCodes(){
    }

    public function actionVideo() {
        $this->render('video');
    }
}