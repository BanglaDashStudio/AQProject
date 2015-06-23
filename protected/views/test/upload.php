<?php
/**
 * Created by PhpStorm.
 * User: theantonysurikoff
 * Date: 23.06.15
 * Time: 19:10
 */
?>

<form enctype="multipart/form-data" action="<?php echo $this->createUrl('test/upload');?>" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <input name="image" type="file" accept="image/jpeg,image/png,image/gif"/>
    <input type="submit" value="upload image" />
</form>