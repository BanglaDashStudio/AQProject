<?php
/* @var $this TeamcrudController */
/* @var $model Team */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'team-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NameTeam'); ?>
		<?php echo $form->textArea($model,'NameTeam',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'NameTeam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DescriptionTeam'); ?>
		<?php echo $form->textArea($model,'DescriptionTeam',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'DescriptionTeam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EmailTeam'); ?>
		<?php echo $form->textArea($model,'EmailTeam',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'EmailTeam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PasswordTeam'); ?>
		<?php echo $form->textArea($model,'PasswordTeam',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'PasswordTeam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PageTeam'); ?>
		<?php echo $form->textArea($model,'PageTeam',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'PageTeam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PhoneTeam'); ?>
		<?php echo $form->textArea($model,'PhoneTeam',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'PhoneTeam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RowTeam'); ?>
		<?php echo $form->textField($model,'RowTeam'); ?>
		<?php echo $form->error($model,'RowTeam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IdGame'); ?>
		<?php echo $form->textField($model,'IdGame'); ?>
		<?php echo $form->error($model,'IdGame'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->