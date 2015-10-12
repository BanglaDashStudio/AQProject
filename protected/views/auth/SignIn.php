<?php
/* @var $this ComandSignInController */
/* @var $model ComandSignIn */
/* @var $form CActiveForm */
?>

<div class="form" >

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comand-sign-in-SignIn-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username', array('placeholder'=>'Название','class'=>'pretty_input_text')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password', array('placeholder'=>'Паролечка','class'=>'pretty_input_text')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Войти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->