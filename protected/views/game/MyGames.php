<?php
/* @var $this GameController */
/* @var $form CActiveForm */
?>

<div class="form">

    <h1>Это игры, написанные вами: </h1>

    <?php
    echo "<ul>";
    foreach($model as $game) {
        echo "<li>" . "<a href=\"" . Yii::app()->createUrl("game/Tasks", array("idG" => $game->IdGame))."\">";
            echo $game->NameGame;
            echo "</a>";
        echo "</li>";
    }
    echo "</ul>";
        ?>

    <div>
        <?php echo "<a href=".Yii::app()->createUrl("game/Create").">Создать новую игру</a>";?>
    </div>


</div><!-- form -->