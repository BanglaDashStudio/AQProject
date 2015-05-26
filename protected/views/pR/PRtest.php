<?php
/* @var $this PRPasswordController */
/* @var $model PRPassword */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'prpassword-PRtest-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'oldpassword'); ?>
		<?php echo $form->textField($model,'oldpassword'); ?>
		<?php echo $form->error($model,'oldpassword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'newpassword'); ?>
		<?php echo $form->textField($model,'newpassword'); ?>
		<?php echo $form->error($model,'newpassword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'confpassword'); ?>
		<?php echo $form->textField($model,'confpassword'); ?>
		<?php echo $form->error($model,'confpassword'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->