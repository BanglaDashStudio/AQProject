<?php
/* @var $this PRInfoController */
/* @var $model PRInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'prinfo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mail'); ?>
		<?php echo $form->textField($model,'mail'); ?>
		<?php echo $form->error($model,'mail'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'page'); ?>
        <?php echo $form->textArea($model,'page'); ?>
        <?php echo $form->error($model,'page'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'inform'); ?>
		<?php echo $form->textArea($model,'inform'); ?>
		<?php echo $form->error($model,'inform'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить',array('class'=>'pretty_submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->