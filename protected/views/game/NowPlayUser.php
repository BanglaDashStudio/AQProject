<?php
/* @var $this GameController */
/* @var $model Code */
/* @var $form CActiveForm */
?>

<div class="playform" >
    <form id="formforplayform" action="<?php echo $this->createUrl('game/play'); ?>" method="post">

<?php
    echo 'Задание  - ', $media_task->description . "". '<br>';
    echo 'Подсказка  - ', $media_hint->description . "". '<br>';

    echo  '<input name="codeUser" type="text" size="3" value = '. ' '.'>'. '<br>';

    echo 'Кодов на локации  - ', $count_codes . "". '<br>';
    echo 'Найдено кодов  - ', $count_codeteam . "". '<br>';

   /* foreach ($codeteamforcount as $codeteamforcountone) {
        echo 'Найденые коды  - ', $codeteamforcountone . "" . '<br>';
    }
*/

    echo CHtml::submitButton('ок');

?>

    </form>
</div>