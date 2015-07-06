<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 28.06.2015
 * Time: 4:18
 */

/* @var media Media */

//$media = Media::model()->findByPk(17);

?>
<style>
.media_img{
    max-height: 300px;
    max-width: 100%;
}
</style>

<label>Изображение:</label><br />
<hr />
<img class="media_img" src="<?php if(isset($media->image)) echo $media->image; ?>">
</img>
<hr />
<label>Аудио:</label><br />
<audio controls>
    <source src="<?php if(isset($media->audio)) echo $media->audio; ?>" />
    Тег audio не поддерживается вашим браузером.
    <a href="<?php if(isset($media->audio)) echo $media->audio; ?>">Скачайте музыку</a>.
</audio>

<hr />
<label>Видио:</label>
<div>
    <?php if(isset($media->video))echo $media->video; ?>
</div>
<hr />
<label>Текст:</label>
<p><?php if(isset($media->description))echo $media->description; ?></p>


<script>
    $(".media_img").on('click',downLoadImage);

    function downLoadImage(){
        var link = $(this).attr('src');
        document.location.href = link;
    }

</script>