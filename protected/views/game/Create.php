<?php
/* @var $this GameController */
/* @var $model Game */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'game-Create-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'z1'); ?>
		<?php echo $form->textField($model,'z1'); ?>
		<?php echo $form->error($model,'z1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'z2'); ?>
		<?php echo $form->textField($model,'z2'); ?>
		<?php echo $form->error($model,'z2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'z3'); ?>
		<?php echo $form->textField($model,'z3'); ?>
		<?php echo $form->error($model,'z3'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->