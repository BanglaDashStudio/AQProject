<?php
/* @var $this GameController */
/* @var $form CActiveForm */
?>

<div class="form">

    <h1>Это игры, написанные вами: </h1>

    <?php
    echo "<ul>";
    foreach($model as $game) {
        echo "<li>" . "<a href=\"" . Yii::app()->createUrl("game/listgame", array("id" => $game->id))."\">";
            echo $game->name;
            echo "</a>";
        echo "</li>";
    }
    echo "</ul>";
        ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Создать игру'); ?>
    </div>



</div><!-- form -->