<?php
/* @var $this GameController */
/* @var $form CActiveForm */
?>

<div class="form">

    <h1>Выберите одно из действий плизыч </h1>

    <div class="row buttons">
        <?php echo CHtml::link('Создать игру','#',array('class'=>'btn')); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Редактировать игры'); ?>
    </div>

</div><!-- form -->