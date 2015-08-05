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

    <hr />
    <style>
    .media_img{
    max-height: 300px;
    max-width: 100%;
    }
    </style>
    <div>
    <?php
        $media = Media::model()->findByPk($mediaId);
    ?>

    <img class="media_img" src="<?php if(isset($media->image)) echo $media->image; ?>">
    </img>
    </div>

    <div>
    <audio controls>
        <source src="<?php if(isset($media->audio)) echo $media->audio; ?>" />
    Тег audio не поддерживается вашим браузером.
    <a href="<?php if(isset($media->audio)) echo $media->audio; ?>">Скачайте музыку</a>.
    </audio>
    </div>
    <div>
    <?php if(isset($media->video))echo $media->video; ?>
    </div>

    <div class="row buttons">
        <input id="addAudioTask" onclick="go('<?php echo $this->createUrl('taskCreator/uploadAudio',array('mediaId'=>$mediaId,'gameId'=>$gameId,'taskId'=>$taskId))?>')" type="button" value="Добавить аудио" />
        <input id="addImageTask" onclick="go('<?php echo $this->createUrl('taskCreator/uploadImage',array('mediaId'=>$mediaId,'gameId'=>$gameId,'taskId'=>$taskId))?>')" type="button" value="Добавить изображение" />
        <input id="addVideoTask" onclick="go('<?php echo $this->createUrl('taskCreator/uploadVideo',array('mediaId'=>$mediaId,'gameId'=>$gameId,'taskId'=>$taskId))?>')" type="button" value="Добавить видео" />
    </div>

    <hr />
    
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

    $(".media_img").on('click',downLoadImage);

    function downLoadImage(){
        var link = $(this).attr('src');
        document.location.href = link;
    }


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