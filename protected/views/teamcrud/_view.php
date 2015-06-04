<?php
/* @var $this TeamcrudController */
/* @var $data Team */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('IdTeam')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->IdTeam), array('view', 'id'=>$data->IdTeam)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NameTeam')); ?>:</b>
	<?php echo CHtml::encode($data->NameTeam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DescriptionTeam')); ?>:</b>
	<?php echo CHtml::encode($data->DescriptionTeam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmailTeam')); ?>:</b>
	<?php echo CHtml::encode($data->EmailTeam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PasswordTeam')); ?>:</b>
	<?php echo CHtml::encode($data->PasswordTeam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PageTeam')); ?>:</b>
	<?php echo CHtml::encode($data->PageTeam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PhoneTeam')); ?>:</b>
	<?php echo CHtml::encode($data->PhoneTeam); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('RowTeam')); ?>:</b>
	<?php echo CHtml::encode($data->RowTeam); ?>
	<br />

	*/ ?>

</div>