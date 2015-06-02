<?php
/* @var $this TeamController */
/* @var $model Team */

$this->breadcrumbs=array(
	'Teams'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Team', 'url'=>array('index')),
	array('label'=>'Manage Team', 'url'=>array('admin')),
);
?>

<h1>Create Team</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>