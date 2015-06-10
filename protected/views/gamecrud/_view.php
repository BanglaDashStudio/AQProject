<?php
/* @var $this GamecrudController */
/* @var $data Game */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('IdGame')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->IdGame), array('view', 'id'=>$data->IdGame)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NameGame')); ?>:</b>
	<?php echo CHtml::encode($data->NameGame); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DescriptionGame')); ?>:</b>
	<?php echo CHtml::encode($data->DescriptionGame); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Date')); ?>:</b>
	<?php echo CHtml::encode($data->Date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IdType')); ?>:</b>
	<?php echo CHtml::encode($data->IdType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StartGame')); ?>:</b>
	<?php echo CHtml::encode($data->StartGame); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FinishGame')); ?>:</b>
	<?php echo CHtml::encode($data->FinishGame); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('AcceptGame')); ?>:</b>
	<?php echo CHtml::encode($data->AcceptGame); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Comment')); ?>:</b>
	<?php echo CHtml::encode($data->Comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IdTeam')); ?>:</b>
	<?php echo CHtml::encode($data->IdTeam); ?>
	<br />

	*/ ?>

</div>