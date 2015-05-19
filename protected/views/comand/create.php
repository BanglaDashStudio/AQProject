<?php
/* @var $this ComandController */
/* @var $model Comand */

$this->breadcrumbs=array(
	'Comands'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Comand', 'url'=>array('index')),
	array('label'=>'Manage Comand', 'url'=>array('admin')),
);
?>

<h1>Create Comand</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>