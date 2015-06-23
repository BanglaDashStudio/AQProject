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
}