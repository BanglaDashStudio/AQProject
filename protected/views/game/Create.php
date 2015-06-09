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
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NameGame'); ?>
		<?php echo $form->textField($model,'NameGame'); ?>
		<?php echo $form->error($model,'NameGame'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DescriptionGame'); ?>
		<?php echo $form->textField($model,'DescriptionGame'); ?>
		<?php echo $form->error($model,'DescriptionGame'); ?>
	</div>

    <?php echo $form->labelEx($model,'Date'); ?>
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'Date',
        'model' => $model,
        'attribute' => 'Date',
        'language' => 'ru',
        'options' => array(
            'showAnim' => 'fold',
            'dateFormat'=>'yy-mm-dd',
        ),
    ));?>

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
        <?php echo $form->textField($model,'Comment'); ?>
        <?php echo $form->error($model,'Comment'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
