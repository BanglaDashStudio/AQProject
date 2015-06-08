<?php
/* @var $this GamecrudController */
/* @var $model Game */

$this->breadcrumbs=array(
	'Games'=>array('index'),
	$model->IdGame=>array('view','id'=>$model->IdGame),
	'Update',
);

$this->menu=array(
	array('label'=>'List Game', 'url'=>array('index')),
	array('label'=>'Create Game', 'url'=>array('create')),
	array('label'=>'View Game', 'url'=>array('view', 'id'=>$model->IdGame)),
	array('label'=>'Manage Game', 'url'=>array('admin')),
);
?>

<h1>Update Game <?php echo $model->IdGame; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>