<?php
/* @var $this GameController */
/* @var $TaskCreate TaskCreateForm*/
/* @var $GameCreate GameCreate*/
/* @var $Task TaskCreateForm*/
$this->breadcrumbs=array(
    'Список созданных игр'=>array('MyGames'),
    'Редактор игры',
);
?>

    <?php echo "<a href=".Yii::app()->createUrl("game/GameEdit", array ('idG' => $idG)).">редактить игру</a>";?>

    <!-- view для заданий одной игры, список заданий и кнопка на добавление нового задания  -->

    <h1>Добавляйте задания</h1>

    <?php $this->renderPartial('TaskList', array('TaskList'=>$Task, 'idG' => $idG) ); ?>

    <?php $this->renderPartial('TaskCreate', array('model'=>$TaskCreate, 'idG' => $idG)); ?>
