<?php
/* @var $this GameController */
/* @var $form CActiveForm */
?>

<div class="form">

    <h1>Добавляйте задания</h1>

    <div class="row">
        <?php echo $form->labelEx($model,'Задание'); ?>
        <?php echo $form->textField($model,'Task'); ?>
        <?php echo $form->error($model,'Task'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Записать'); ?>
    </div>

</div><!-- form -->