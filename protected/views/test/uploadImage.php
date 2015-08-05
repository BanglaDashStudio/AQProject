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
<label>Изображение:</label><br />
<img class="media_img" src="<?php echo $media->image;?>">
</img>
<?php endif; ?>


<form class="uploadForms" enctype="multipart/form-data" action="<?php echo $this->createUrl('test/uploadImage',array('mediaId'=>$mediaId));?>" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000000000" />
    <input type="file" name="uploadImage" accept="image/jpeg,image/png,image/gif" />
    <input type="submit" value="upload image" />
</form>

<input type="button" value="Готово" onclick="go('<?php echo $this->createUrl('test/createTaskTest',array('gameId'=>$gameId))?>')">
<script>
    $(".media_img").on('click',downLoadImage);

    function downLoadImage(){
        var link = $(this).attr('src');
        document.location.href = link;
    }

</script>