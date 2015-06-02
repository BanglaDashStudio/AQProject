<?php
/* @var $this GameController */
/* @var $model GameCreate */
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

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Название игры'); ?>
		<?php echo $form->textField($model,'NameGame'); ?>
		<?php echo $form->error($model,'NameGame'); ?>
	</div>

   <//div class="row">
       <//?php echo $form->labelEx($model,'Дата'); ?>
        <//?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array
        (
            'name'=>'ModelName[date]', // the name of the field
            'language'=>'ru',
            'value'=>($model->date ? date('yy-mm-dd', $model->date) : ''),  // pre-fill the value
            'options'=>array
            (
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',  // optional Date formatting
                'debug'=>false,
            ),
            'htmlOptions'=>array
            (
                'style'=>'height:20px;'
            ),
        ));
        ?>
        <//?php echo $form->error($model,'date'); ?>
    <///div>

	<div class="row">
		<?php echo $form->labelEx($model,'Описание'); ?>
		<?php echo $form->textField($model,'DescriptionGame'); ?>
		<?php echo $form->error($model,'DescriptionGame'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->