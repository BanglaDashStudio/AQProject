<?php
/* @var $this GameController */
/* @var $TaskCreate TaskCreateForm*/
/* @var $GameCreate GameCreate*/
/* @var $Task TaskCreateForm*/

$this->breadcrumbs=array(
    'Список созданных игр'=>array('MyGames'),
    'Редактор игры',
);

Yii::app()->clientScript->registerScript('search', "
$('.gameedit-button').click(function(){
	$('.gameedit-form').toggle();
	return false;
});
");
?>
<!-- view для заданий одной игры, список заданий и кнопка на добавление нового задания  -->
<?php

echo CHtml::link('Информация об игре','#',array('class'=>'gameedit-button')); ?>


<div class="gameedit-form"
<?php
if(!$gameEditModel->hasErrors()) {
    echo 'style="display:none">';
}
?>

<?php $this->renderPartial('_gameedit', array('model'=>$gameEditModel)); ?>
</div>

<?php $this->renderPartial('_tasklist', array('TaskList'=>$Task, 'gameId' => $gameId) ); ?>

<?php $this->renderPartial('_taskcreate', array('model'=>$TaskCreate, 'gameId' => $gameId)); ?>
