<?php
/* @var $this GamecrudController */
/* @var $model Game */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'game-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NameGame'); ?>
		<?php echo $form->textArea($model,'NameGame',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'NameGame'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DescriptionGame'); ?>
		<?php echo $form->textArea($model,'DescriptionGame',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'DescriptionGame'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IdType'); ?>
		<?php echo $form->textField($model,'IdType'); ?>
		<?php echo $form->error($model,'IdType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'StartGame'); ?>
		<?php echo $form->textField($model,'StartGame'); ?>
		<?php echo $form->error($model,'StartGame'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FinishGame'); ?>
		<?php echo $form->textField($model,'FinishGame'); ?>
		<?php echo $form->error($model,'FinishGame'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Comment'); ?>
		<?php echo $form->textArea($model,'Comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AcceptGame'); ?>
		<?php echo $form->textField($model,'AcceptGame'); ?>
		<?php echo $form->error($model,'AcceptGame'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IdTeam'); ?>
		<?php echo $form->textField($model,'IdTeam'); ?>
		<?php echo $form->error($model,'IdTeam'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->