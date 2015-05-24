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

	<p class="note"><span class="required">*</span> Обязательные поля.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Название'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'Дата'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array
        (
            'name'=>'ModelName[date]', // the name of the field
            'language'=>'ru',
            'value'=>($model->date ? date('d.m.Y', $model->date) : ''),  // pre-fill the value
            'options'=>array
            (
                'showAnim'=>'fold',
                'dateFormat'=>'dd.mm.yy',  // optional Date formatting
                'debug'=>false,
            ),
            'htmlOptions'=>array
            (
                'style'=>'height:20px;'
            ),
        ));
        ?>
        <?php echo $form->error($model,'date'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'Задание 1'); ?>
		<?php echo $form->textField($model,'z1'); ?>
		<?php echo $form->error($model,'z1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Задание 2'); ?>
		<?php echo $form->textField($model,'z2'); ?>
		<?php echo $form->error($model,'z2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Задание 3'); ?>
		<?php echo $form->textField($model,'z3'); ?>
		<?php echo $form->error($model,'z3'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->