<?php
/* @var $this TaskCreateFormController */
/* @var $model TaskCreateForm */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
    'Список созданных игр'=>array('MyGames'),
    'Редактировать задание',
);
?>

<div class="form">

    <!-- view для редактирования одного задания  -->

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-create-form-TaskEdit-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны к заполнению.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'taskname'); ?>
        <?php echo $form->textField($model,'taskname'); ?>
        <?php echo $form->error($model,'taskname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'task'); ?>
        <?php echo $form->textField($model,'task', array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'task'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->textField($model,'type'); ?>
        <?php echo $form->error($model,'type'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'tip'); ?>
        <?php echo $form->textField($model,'tip', array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'tip'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'address'); ?>
        <?php echo $form->textField($model,'address'); ?>
        <?php echo $form->error($model,'address'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class'=>'pretty_button')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->