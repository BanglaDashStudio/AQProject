<?php
/* @var $this TeamcrudController */
/* @var $model Team */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'IdTeam'); ?>
		<?php echo $form->textField($model,'IdTeam'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NameTeam'); ?>
		<?php echo $form->textArea($model,'NameTeam',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DescriptionTeam'); ?>
		<?php echo $form->textArea($model,'DescriptionTeam',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EmailTeam'); ?>
		<?php echo $form->textArea($model,'EmailTeam',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PasswordTeam'); ?>
		<?php echo $form->textArea($model,'PasswordTeam',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PageTeam'); ?>
		<?php echo $form->textArea($model,'PageTeam',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PhoneTeam'); ?>
		<?php echo $form->textArea($model,'PhoneTeam',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RowTeam'); ?>
		<?php echo $form->textField($model,'RowTeam'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->