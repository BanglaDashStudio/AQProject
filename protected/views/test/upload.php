<?php
/**
 * Created by PhpStorm.
 * User: theantonysurikoff
 * Date: 23.06.15
 * Time: 19:10
 */
?>
<style>
    .uploadForms {
        background-color: #DDDDDD;
        padding-left: 5px;
        padding-top: 5px;
        padding-bottom: 5px;
    }

</style>

<form class="uploadForms" enctype="multipart/form-data" action="<?php echo $this->createUrl('test/uploadimage');?>" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
    <input type="file" name="uploadImage" accept="image/jpeg,image/png,image/gif" />
    <input type="submit" value="upload image" />
</form>

<br />

<form class="uploadForms" enctype="multipart/form-data" action="<?php echo $this->createUrl('test/uploadaudio');?>" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
    <input type="file" name="uploadAudio" accept="audio/*" />
    <input type="submit" value="upload audio" />
</form>

<br />

<form class="uploadForms" enctype="multipart/form-data" action="<?php echo $this->createUrl('test/upload');?>" method="POST">
    <textarea name="description" ></textarea>
    <br />
    <input type="submit" value="Add text" />
</form>

