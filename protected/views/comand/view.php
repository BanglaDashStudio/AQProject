<?php
/* @var $this ComandController */
/* @var $model Comand */

$this->breadcrumbs=array(
	'Comands'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List Comand', 'url'=>array('index')),
	array('label'=>'Create Comand', 'url'=>array('create')),
	array('label'=>'Update Comand', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Comand', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Comand', 'url'=>array('admin')),
);
?>

<h1>View Comand #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Name',
		'Pass',
		'Phone',
		'Description',
	),
)); ?>
