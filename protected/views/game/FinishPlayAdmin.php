<?php
/* @var $this GameController */
/* @var $model Code */
/* @var $results Results */
/* @var $form CActiveForm */
/* @var $teamList Team */
/* @var $taskList Task */

Yii::app()->clientScript->registerScript('res', "
$('.grid_button').click(function(){
	$('.resform').toggle();
	return false;
});
");

?>
Игра закончена, правьте результаты по бонусам и простоям :
<div class="resform" >
   <form id="formforresform" action="<?php echo $this->createUrl('game/play'); ?>" method="post">

<?php

echo "<table border='1' style='border: solid'>";

echo "<tr>";
echo"<th>";
echo '~~~';
echo "</th>";
echo "<th>";
echo "команда";
echo "</th>";
foreach ($taskList as $task) {
    echo "<th>";
    echo $task->name;
    echo "</th>";
}
echo "<th>";
echo "общее время выполнения";
echo "</th>";
echo "</tr>";

foreach ($results as $team) {
    echo "<tr>";
    echo "<th>";
    echo $team->score;
    echo "</th>";

    $tt=Team::model()->findByAttributes(array('id'=>$team->teamId));

    echo "<td>";
    echo $tt->name;
    echo "</td>";

    //время выполнения заданий
    $grid = Grid::model()->findAllByAttributes(array('teamId'=>$team->teamId, 'gameId'=>$team->gameId));

    foreach ($grid as $gridteam) {

        foreach ($taskList as $task) {

            if($gridteam->taskId == $task->id) {
                echo "<th>";
                if ($gridteam->timeForTask != NULL)
                    echo date('H:i', $gridteam->timeForTask);
                else echo '--';
                echo "</th>";
            }
        }
    }

    foreach ($results as $result) {
        if ($result->teamId == $tt->id) {
            echo "<td>";
            echo '<input ';
            echo 'name="ResForm['.$result->teamId.']"';
            echo 'type="text" size="3" value = ' .date('H:i',$result->time) . '>';
            echo "</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";

echo CHtml::submitButton('Сохранить изменения');?>

   </form>
</div>
