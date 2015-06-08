<?php
/* @var $this GameController */
/* @var $TaskList */
?>

    <?php
    if (isset($TaskList)) {
        echo "<ul>";
        foreach ($TaskList as $Task) {

            echo "<li>" ;
            echo $Task->DescriptionTask;
            echo "<a href=\"" . Yii::app()->createUrl("game/EditTask", array("id" => $Task->IdTask)) . "\">";
            echo CHtml::submitButton('Редактировать');
            echo "</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
    ?>