<?php

class TestController extends Controller
{

    public function actionUploadImage() {
        //var_dump($_POST);
        //var_dump($_FILES);

        $uploaddir = 'data/images/';
        $uploadfile = $uploaddir . $_FILES['uploadImage']['name'];

        //var_dump($_FILES['uploadImage']['tmp_name']);

        if (move_uploaded_file(($_FILES['uploadImage']['tmp_name']), $uploadfile)) {
            $link = $uploadfile;



        } else {
            echo "Ошибка загрузки аудио!\n";
        }

    }

    public function actionUploadAudio() {
        var_dump($_POST);
        var_dump($_FILES);

    }

    public function actionIndex() {
        $this->render('upload');
    }

    public function actionNow() {
        $time = Game::model()->findByPk(11);

        $str_time = $time->start;
        $hours=0;
        $minutes=0;
        $seconds=0;
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;

        echo time();
        echo '<br />';
        echo strtotime($time->date);
        echo '<br />';
        echo strtotime($time->date)+$time_seconds;
    }
}