<?php
/* @var $this GameController */
/* @var $TaskList */
?>

    <?php
    if (isset($TaskList)) {
        echo "<ul>";
        foreach ($TaskList as $Task) {
            echo "<li>" ;
            echo '<button onclick="go(\'';
            echo Yii::app()->createUrl("game/taskEdit", array("taskId" => $Task->id, "gameId" => $Task->gameId));
            echo '\')" class="btEdit" title="Редактировать">E</button>';
            echo '<button onclick="go(\'';
            echo Yii::app()->createUrl("game/deleteTask", array("taskId" => $Task->id, "gameId" => $Task->gameId));
            echo '\')" class="btEdit" title="Удалить">D</button>';
            echo $Task->description;
            echo "</li>";
        }
        echo "</ul>";
    }
    ?>