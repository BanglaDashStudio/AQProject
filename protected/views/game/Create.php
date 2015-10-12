<?php
/* @var $this GameController */
/* @var $model GameCreate */
/* @var $form CActiveForm */
$this->breadcrumbs=array(
    'Список созданных игр'=>array('MyGames'),
    'Редактор игры',
);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'game-Create-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <p class="note">Поля со <span class="required">*</span> обязательны для заполнения.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

    <?php echo $form->labelEx($model,'date'); ?>
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'date',
        'model' => $model,
        'attribute' => 'date',
        'language' => 'ru',
        'options' => array(
            'showAnim' => 'fold',
            'dateFormat'=>'yy-mm-dd',
        ),
    ));?>

<div class="row">
    <?php echo $form->labelEx($model,'start'); ?>
    <?php echo $form->textField($model,'start'); ?>
    <?php echo $form->error($model,'start'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'type'); ?>
    <?php echo $form->textField($model,'type'); ?>
    <?php echo $form->error($model,'type'); ?>
</div>

    <div class="row">
        <?php echo $form->labelEx($model,'comment'); ?>
        <?php echo $form->textField($model,'comment'); ?>
        <?php echo $form->error($model,'comment'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить', array('class'=>'pretty_submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
