<?php
/* @var $this TaskCreateFormController */
/* @var $model TaskCreateForm */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScript('create_task', "
$('.task-button').click(function(){
$('.task-form').toggle();
return false;
});
");
?>
<?php
echo CHtml::link('Добавить задание','#',array('class'=>'task-button')); ?>
<div class="task-form" style="display: none">
    <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'task-create-form-TaskCreate-form',
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// See class documentation of CActiveForm for details on this,
// you need to use the performAjaxValidation()-method described there.
            'enableAjaxValidation'=>false,
            'action'=> $this->CreateUrl('/game/TaskCreate', array('idG'=>$idG)),
        )); ?>
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
            <?php echo $form->labelEx($model,'tip'); ?>
            <?php echo $form->textField($model,'tip', array('size'=>60,'maxlength'=>128)); ?>
            <?php echo $form->error($model,'tip'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'code'); ?>
            <?php echo $form->textField($model,'code'); ?>
            <?php echo $form->error($model,'code'); ?>
        </div>
        <div class="row buttons">
            <?php echo CHtml::submitButton('Добавить'); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->