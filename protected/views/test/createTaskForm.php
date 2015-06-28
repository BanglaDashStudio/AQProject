<?php
/* @var $this TaskCreateController */
/* @var $createTaskForm TaskCreate */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-create-createTaskForm-form',
    'action'=>$this->createUrl('test/createTaskTest',array('gameId'=>$gameId)),
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Поля с <span class="required">*</span> являются обязательными.</p>

	<?php echo $form->errorSummary($createTaskForm); ?>

	<div class="row">
		<?php echo $form->labelEx($createTaskForm,'name'); ?>
		<?php echo $form->textField($createTaskForm,'name'); ?>
		<?php echo $form->error($createTaskForm,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($createTaskForm,'description'); ?>
		<?php echo $form->textArea($createTaskForm,'description'); ?>
		<?php echo $form->error($createTaskForm,'description'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($createTaskForm,'address'); ?>
        <?php echo $form->textField($createTaskForm,'address'); ?>
        <?php echo $form->error($createTaskForm,'address'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($createTaskForm,'type'); ?>
        <?php echo $form->textField($createTaskForm,'type'); ?>
        <?php echo $form->error($createTaskForm,'type'); ?>
    </div>

    <div class="row">
		<?php echo $form->labelEx($createTaskForm,'code'); ?>
		<?php echo $form->textField($createTaskForm,'code'); ?>
		<?php echo $form->error($createTaskForm,'code'); ?>
	</div>

    <div id="CodeList">

    </div>
    <input type="button" id="addCode" value="Добавить код" />

    <div class="row buttons">
		<?php echo CHtml::submitButton('Далее'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script>
    $('#addCode').on('click', addCode);

    var counter = 1;
    var amount = 1;

    function addCode(){
        if(amount >= 10){
            alert('Не больше 10 кодов для задания!');
            return;
        }


        var list = $('#CodeList');
        var del = $('<input type="button" value="Удалить" />');
        var input = $('<input name="TaskCreate[codes]['+ counter +']"  type="text" />');
        var item = $("<div></div>");
        var count = $('[name = code_amount]');

        counter++;
        amount++;

        count.val(counter);

        del.on('click',deleteCode);

        item.append(input);
        item.append(del);
        list.append(item);
    }

    function deleteCode(){
        $(this).parent().remove();
        amount--;
    }

</script>