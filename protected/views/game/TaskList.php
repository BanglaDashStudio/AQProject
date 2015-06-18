<?php
/* @var $this GameController */
/* @var $TaskList */
?>

    <?php
    if (isset($TaskList)) {
        echo "<ul>";
        foreach ($TaskList as $Task) {

            echo "<li>" ;
            echo $Task->description;
            echo "<a href=\"" . Yii::app()->createUrl("game/TaskEdit", array("IdTask" => $Task->id, "idG" => $Task->gameId)) . "\">";
            echo CHtml::submitButton('', array('class' => 'btEdit', 'title'=> 'Редактировать'));
            echo "</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
    ?>