<?php
/**
 * Created by PhpStorm.
 * User: theantonysurikoff
 * Date: 26.06.15
 * Time: 7:20
 */

/* @var gameId */
?>

<?php
/* @var $this TaskCreateFormController */
/* @var $taskCreateForm TaskCreateForm */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'task-create-form-tcf-form',
        'action'=>$this->createUrl('taskCreator/saveTask',array('gameId'=>$gameId)),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($taskCreateForm); ?>

    <div class="row">
        <?php echo $form->labelEx($taskCreateForm,'task'); ?>
        <?php echo $form->textField($taskCreateForm,'task'); ?>
        <?php echo $form->error($taskCreateForm,'task'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($taskCreateForm,'taskname'); ?>
        <?php echo $form->textField($taskCreateForm,'taskname'); ?>
        <?php echo $form->error($taskCreateForm,'taskname'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

