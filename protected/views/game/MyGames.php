<?php
/* @var $this GameController */
/* @var $form CActiveForm */
?>

<div class="form">

    <h1>Это игры, написанные вами: </h1>

    <?php
    echo "<ul>";
    foreach($model as $game) {
        echo "<li>";

        echo '<button onclick="go(\'';
        echo Yii::app()->createUrl("game/Tasks", array("gameId" => $game->id));
        echo '\')" class="btEdit" title="Редактировать">E</button>';

        echo '<button onclick="go(\'';
        echo Yii::app()->createUrl("game/deleteGame", array("gameId" => $game->id));
        echo '\')" class="btEdit" title="Удалить">D</button>';

        echo $game->name;

        echo "</li>";
    }
    echo "</ul>";
        ?>

    <div>
        <?php echo "<a href=".Yii::app()->createUrl("game/Create").">Создать новую игру</a>";?>
    </div>


</div><!-- form -->