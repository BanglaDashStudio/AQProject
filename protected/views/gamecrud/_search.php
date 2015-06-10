<?php
/* @var $this GamecrudController */
/* @var $model Game */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'IdGame'); ?>
		<?php echo $form->textField($model,'IdGame'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NameGame'); ?>
		<?php echo $form->textArea($model,'NameGame',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DescriptionGame'); ?>
		<?php echo $form->textArea($model,'DescriptionGame',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Date'); ?>
		<?php echo $form->textField($model,'Date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IdType'); ?>
		<?php echo $form->textField($model,'IdType'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'StartGame'); ?>
		<?php echo $form->textField($model,'StartGame'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FinishGame'); ?>
		<?php echo $form->textField($model,'FinishGame'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AcceptGame'); ?>
		<?php echo $form->textField($model,'AcceptGame'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Comment'); ?>
		<?php echo $form->textArea($model,'Comment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IdTeam'); ?>
		<?php echo $form->textField($model,'IdTeam'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->