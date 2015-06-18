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
<!-- view для заданий одной игры, список заданий и кнопка на добавление нового задания  -->
<?php
    $game=Game::model()->findByAttributes(array('id'=>$idG));
    echo '<h2>'.$game->name. '</h2>';
    echo "<a href=".Yii::app()->createUrl("game/GameEdit", array ('idG' => $idG)).">Редактировать игру</a>";?>

    <h1>Добавляйте задания</h1>

    <?php $this->renderPartial('TaskList', array('TaskList'=>$Task, 'idG' => $idG) ); ?>

    <?php $this->renderPartial('TaskCreate', array('model'=>$TaskCreate, 'idG' => $idG)); ?>
