<?php
/* @var $this GameeditController */
/* @var $model Game */

$this->breadcrumbs=array(
	'Games'=>array('index'),
	$model->IdGame,
);

$this->menu=array(
	array('label'=>'List Game', 'url'=>array('index')),
	array('label'=>'Create Game', 'url'=>array('create')),
	array('label'=>'Update Game', 'url'=>array('update', 'id'=>$model->IdGame)),
	array('label'=>'Delete Game', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->IdGame),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Game', 'url'=>array('admin')),
);
?>

<h1>View Game #<?php echo $model->IdGame; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'IdGame',
		'NameGame',
		'DescriptionGame',
		'IdType',
		'Date',
		'StartGame',
		'FinishGame',
		'Comment',
		'AcceptGame',
	),
)); ?>
