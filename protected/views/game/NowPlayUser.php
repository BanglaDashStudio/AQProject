<?php
/* @var $this GameController */
/* @var $model Code */
/* @var $form CActiveForm */
?>
<?php


    echo 'Задание  - ', $task->description . "". '<br>';
    echo 'Подсказка  - ', $hint->description . "". '<br>';

    echo  '<input name="codeUser" type="text" size="3" value = '. ' '.'>'. '<br>';
    //if ( $_POST['codeUser']== $code->code)

    echo CHtml::submitButton('След');


?>

