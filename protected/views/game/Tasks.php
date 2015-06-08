<?php
/* @var $this GameController */
/* @var $TaskCreate TaskCreateForm*/
/* @var $Task TaskCreateForm*/
?>


    <h1>Добавляйте задания</h1>

    <?php $this->renderPartial('TaskList', array('TaskList'=>$Task, 'idG' => $idG) ); ?>

    <?php $this->renderPartial('TaskCreate', array('model'=>$TaskCreate, 'idG' => $idG)); ?>


