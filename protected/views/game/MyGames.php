<?php
/* @var $this GameController */
/* @var $form CActiveForm */
?>

<div class="form">

    <h1>Выберите одно из действий: </h1>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Создать игру'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Редактировать игры'); ?>
    </div>

</div><!-- form -->