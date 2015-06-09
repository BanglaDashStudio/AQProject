<?php
/* @var $this GameController */
/* @var $TaskList */
?>
    <!-- view для  списка заданий одной игры -->


    <?php
    if (isset($TaskList)) {
        echo "<ul>";
        foreach ($TaskList as $Task) {

            echo "<li>" ;
            echo $Task->DescriptionTask;
            echo "<a href=\"" . Yii::app()->createUrl("game/EditTask", array("IdTask" => $Task->IdTask, "idG" => $Task->IdGame)) . "\">";
            echo CHtml::submitButton('Редактировать');
            echo "</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
    ?>