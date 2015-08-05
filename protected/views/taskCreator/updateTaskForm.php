<?php
/* @var $this TaskCreateController */
/* @var $createTaskForm TaskCreate */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'task-create-createTaskForm-form',
        'action'=>$this->createUrl('taskCreator/updateTask',array('gameId'=>$gameId,'taskId'=>$taskId)),
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

    <div class="row buttons">
        <input id="addFileTask" onclick="go('<?php echo $this->createUrl('test/uploadAudio',array('mediaId'=>$mediaId))?>')" type="button" value="Добавить аудио" />
        <input id="addFileTask" onclick="go('<?php echo $this->createUrl('test/uploadImage',array('mediaId'=>$mediaId))?>')" type="button" value="Добавить изображение" />
        <input id="addFileTask" onclick="go('<?php echo $this->createUrl('test/uploadVideo',array('mediaId'=>$mediaId))?>'" type="button" value="Добавить видео" />
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
    <?php
        $amount = 1;
        if(isset($codes)){
            if(count($codes) != 0 ){
                foreach($codes as $code){
                    if($code != '') {
                        echo '<div><input name="TaskCreate[codes][' . $amount . ']"  type="text"';
                        echo 'value="' . $code . '"';
                        echo ' /><input class="deleteBut" type="button" value="Удалить" /></div>';
                        $amount++;
                    }
                }
            }
        }
    ?>

    </div>
    <input type="button" id="addCode" value="Добавить код" />

    <div class="row buttons">
        <?php echo CHtml::submitButton('Cохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->


<script>
    $('#addCode').on('click', addCode);
    $('.deleteBut').on('click',deleteCode);

    var counter = <?php echo $amount?>;
    var amount = <?php echo $amount?>;

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