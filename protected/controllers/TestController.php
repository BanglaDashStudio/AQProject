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
        if(isset($_POST['TaskCreateForm'])) {

            $task = new Task();
            $task->gameId = $gameId;
            $task->name = $_POST['TaskCreateForm']['task'];
            if($task->validate()){
                $task->save();
                $this->render('task',array('taskId'=>$task->id,'task'=>$task));
                return;
            }

        } else {
            $this->redirect($this->createUrl('test/createTask',array('gameId'=>$gameId)));
        }
    }


    public function addCodes(){
    }

    public function actionVideo() {
        $this->render('video');
    }
}