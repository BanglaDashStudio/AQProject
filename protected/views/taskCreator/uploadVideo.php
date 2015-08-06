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


<?php if(isset($media)):?>
    <label>Видео:</label><br />
    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php
    echo $media->video;
    ?>" frameborder="0" allowfullscreen>
    </iframe>
<?php endif; ?>


<form class="uploadForms" action="<?php echo $this->createUrl('taskCreator/uploadVideo',array('mediaId'=>$mediaId,'gameId'=>$gameId,'taskId'=>$taskId));?>" method="POST">
    <input type="text" name="Video" placeholder="Добавьте ссылку на видео"/>
    <input type="submit" value="attach video" />
</form>

<input type="button" value="Готово" onclick="go('<?php echo $this->createUrl('taskCreator/updateTask',array('gameId'=>$gameId,'taskId'=>$taskId))?>')">
