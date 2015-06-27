<?php
/* @var $this GameController */
/* @var $model Code */
/* @var $form CActiveForm */
/* @var $hintT  */

Yii::app()->clientScript->registerScript('grid', "
$('.hint_button').click(function(){
	$('.hintform').toggle();
	return false;
});


$('.address_button').click(function(){
	$('.adrform').toggle();
	return false;
});
");
?>

<div class="playform" >
    <form id="formforplayform" action="<?php echo $this->createUrl('game/play'); ?>" method="post">

<?php
    echo 'Задание  - ', $media_task->description . "". '<br>';?>

    <button class="hint_button">
    Подсказка
    </button> <br>
        <div class="hintform" style="display: none">

            <?php if ((int)time() > $hintT) {echo (int)time().'<br>';

            echo $hintT.'<br>';
                echo 'Подсказка  - ', $media_hint->description . "". '<br>'; } ?>
            <button class="address_button">
                Адрес
            </button><br>
            <div class="adrform" style="display: none">
                <?php  echo 'Адрес  - ', $address . "" . '<br>';  ?>
            </div>
</div>

 <?php

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