<?php
/* @var $this TaskCreateFormController */
/* @var $model TaskCreateForm */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-create-form-_taskcreate-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'task'); ?>
		<?php echo $form->textField($model,'task'); ?>
		<?php echo $form->error($model,'task'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'taskname'); ?>
		<?php echo $form->textField($model,'taskname'); ?>
		<?php echo $form->error($model,'taskname'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->