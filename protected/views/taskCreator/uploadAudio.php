<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 02.08.2015
 * Time: 23:13
 */

/* @var mediaId */
/* @var taskId */

if(isset($mediaId)){
    $media = Media::model()->findByPk($mediaId);
}

?>

<style>
    .media_img{
        max-height: 300px;
        max-width: 100%;
    }
</style>

<?php if(isset($media)):?>
<label>Аудио:</label><br />
    <audio controls>
        <source src="<?php if(isset($media->audio)) echo $media->audio; ?>" />
        Тег audio не поддерживается вашим браузером.
        <a href="<?php if(isset($media->audio)) echo $media->audio; ?>">Скачайте музыку</a>.
    </audio>
<?php endif; ?>


<form class="uploadForms" enctype="multipart/form-data" action="<?php echo $this->createUrl('taskCreator/uploadAudio',array('mediaId'=>$mediaId,'gameId'=>$gameId,'taskId'=>$taskId));?>" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000000000" />
    <input type="file" name="uploadAudio" accept="audio/*" />
    <input type="submit" value="upload audio" />
</form>

<input type="button" value="Готово" onclick="go('<?php echo $this->createUrl('taskCreator/updateTask',array('gameId'=>$gameId,'taskId'=>$taskId))?>')">
