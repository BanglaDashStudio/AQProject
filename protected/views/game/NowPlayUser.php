<?php
/* @var $this GameController */
/* @var $model Code */
/* @var $form CActiveForm */
/* @var $hintT  */

?>

<div class="playform" >
    <form id="formforplayform" action="<?php echo $this->createUrl('game/play'); ?>" method="post">

<?php
    echo 'Задание  - ', $media_task->description . "". '<br>';

    for ($i = 0; $i<$count_hint; $i++) {
        if (isset($hint[$i])) {
            echo 'Подсказка  - ', $media_hint[$i]->description . "" . '<br>';
        }
    }

    if(isset($address)) {
        echo 'Адрес  - ', $address . "" . '<br>';
    }


    echo  '<input name="codeUser" type="text" size="3" value = '. ' '.'>'. '<br>';

    echo 'Кодов на локации  - ', $count_codes . "". '<br>';
    echo 'Найдено кодов  - ', $count_codeteam . "". '<br>';
/*
    echo 'Найденые коды  - ';

    $codes = Code::model()->findAllByAttributes(array("codeId"=>$codeteamforcount->codeId));
    echo $codes;

    foreach ($codes as $code) {
        echo $code->code . "" . '<br>';
    };
*/
    echo CHtml::submitButton('ок');

?>

    </form>
</div>