<?php
/* @var $this GameController */
/* @var $model Code */
/* @var $form CActiveForm */
/* @var $hintT  */

?>

<div class="playform" >
    <form id="formforplayform" action="<?php echo $this->createUrl('game/play'); ?>" method="post">

<?php
    if(isset($media_task)) {
        echo 'Задание  - ', $media_task->description . "" . '<br>';
    }else{
        echo 'error';
    }

    foreach ($view_hint as $item){
        if (isset($item)) {
            echo 'Подсказка  - ', $item->description . '<br>';
        }
    }

    if(isset($view_address)) {
        echo 'Адрес  - ', $view_address .'<br>';
    }


    echo  '<input name="codeUser" type="text" size="3" value = '. ' '.'>'. '<br>';

    echo 'Кодов на локации  - ', $count_codes . "". '<br>';
    echo 'Найдено кодов  - ', $count_codeteam . "". '<br>';

    echo 'Найденые коды  - ';

    foreach ($codeteamforcount as $item) {
        $code = Code::model()->findByAttributes(array("id"=>$item->codeId));
        echo '('.$code->code. ') ';
    }

    echo '<br>';

    echo CHtml::submitButton('ок', array('class'=>'pretty_button'));

?>

    </form>
</div>