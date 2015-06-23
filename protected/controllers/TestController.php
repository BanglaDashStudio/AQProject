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

    public function actionVideo() {
        $this->render('video');
    }
}