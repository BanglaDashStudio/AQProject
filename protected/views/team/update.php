<?php
/* @var $this TeamController */
/* @var $model Team */

$this->breadcrumbs=array(
	'Teams'=>array('index'),
	$model->IdTeam=>array('view','id'=>$model->IdTeam),
	'Update',
);

$this->menu=array(
	array('label'=>'List Team', 'url'=>array('index')),
	array('label'=>'Create Team', 'url'=>array('create')),
	array('label'=>'View Team', 'url'=>array('view', 'id'=>$model->IdTeam)),
	array('label'=>'Manage Team', 'url'=>array('admin')),
);
?>

<h1>Update Team <?php echo $model->IdTeam; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>