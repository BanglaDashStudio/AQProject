<?php
/* @var $this ComandController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comands',
);

$this->menu=array(
	array('label'=>'Create Comand', 'url'=>array('create')),
	array('label'=>'Manage Comand', 'url'=>array('admin')),
);
?>

<h1>Команды</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
