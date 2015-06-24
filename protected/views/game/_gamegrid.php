<?php
/* @var $teamList Team */
/* @var $taskList Task */
/* @var $gridOrder Grid
 */

Yii::app()->clientScript->registerScript('grid', "
$('.grid_button').click(function(){
	$('.gridform').toggle();
	return false;
});
");
?>


<button class="grid_button">
    Сетка
</button>

<div class="gridform" style="display: none">
    <?php

    if(isset($taskList) && isset($teamList) && isset($gridOrder)) {
        echo "<table border='1'>";

        echo "<tr>";
        echo"<th>";
        echo '~~~';
        echo "</th>";
        foreach ($taskList as $task) {
            echo"<th>";
            echo $task->description;
            echo "</th>";
        }
        echo "</tr>";

        foreach ($teamList as $team) {
            echo "<tr>";
            echo "<td>";
            echo $team->name;
            echo "</td>";

            foreach ($gridOrder as $grid) {
                if ($grid->teamId == $team->id) {
                    $i=$grid->orderTask;
                    echo "<td>";
                    echo  '<input name="order" type="text" size="3" value = '. $i.'>';
                    echo "</td>";
                }
            }
            echo "</tr>";

            if (!isset($gridOrder))
            {
                echo "<td>";
                echo  '<input name="order" type="text" size="4" value = '.' '.'>';
                echo "</td>";

            }
        }
        echo "</table>";
    }
    else {
        echo 'заданий нет';
    }
    echo CHtml::submitButton('Сохранить изменения'); ?>
</div>