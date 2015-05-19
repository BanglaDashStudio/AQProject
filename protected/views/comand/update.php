<?php
/* @var $this ComandController */
/* @var $model Comand */

$this->breadcrumbs=array(
	'Comands'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Comand', 'url'=>array('index')),
	array('label'=>'Create Comand', 'url'=>array('create')),
	array('label'=>'View Comand', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Comand', 'url'=>array('admin')),
);
?>

<h1>Update Comand <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>