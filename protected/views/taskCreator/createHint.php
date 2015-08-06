<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 06.08.2015
 * Time: 20:16
 */
?>

<?php if(isset($hintList))if(count($hintList)>0): ?>
<p>Список подсказок:</p>
<ul class="hintList">
    <?php
        foreach($hintList as $hintItem)   {
            $hintMedia = Media::model()->findByPk($hintItem->mediaId);
            echo '<li>';
            echo $media->description;
            echo '</li>';
        }
    ?>
</ul>
<?php endif;?>

<input type="button" id="addHint" value="Добавить подсказку"/>

