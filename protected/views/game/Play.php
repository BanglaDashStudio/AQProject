<?php
/* @var $this GameController */
/* @var $teamList Team */
/* @var $taskList Task */
/* @var $gridOrder Grid
 */

Yii::app()->clientScript->registerScript('teamlist', "
$('.button_team').click(function(){
	$('.team-form').toggle();
	return false;
});
");

Yii::app()->clientScript->registerScript('grig', "
$('.grid_button').click(function(){
	$('.gridform').toggle();
	return false;
});
");

Yii::app()->clientScript->registerScript('button-on', '
$(".button_1").click(
function(){
if (confirm("Вы уверены?")) {
window.location.href = "'.$this->createUrl("game/newOrder", array("IdGame"=>$gameAccept->id, "IdTeam"=>Yii::app()->user->id)).'";
}
return false;
}
);
$(".button_2").click(
function(){
if (confirm("Вы уверены?")) {
window.location.href = "'.$this->createUrl("game/deleteOrder", array("IdGame"=>$gameAccept->id, "IdTeam"=>Yii::app()->user->id)).'";
}
return false;
}
);'
);


Yii::app()->clientScript->registerScript('button-on', '

        $(".button_1").click(
        function(){
            if (confirm("Вы уверены?")) {
                window.location.href = "'.$this->createUrl("game/newOrder", array("gameId"=>$gameAccept->id, "teamId"=>Yii::app()->user->id)).'";
            }
            return false;
	    }
	    );

	    $(".button_2").click(
	    function(){

            if (confirm("Вы уверены?")) {
                window.location.href = "'.$this->createUrl("game/deleteOrder", array("gameId"=>$gameAccept->id, "teamId"=>Yii::app()->user->id)).'";
            }
            return false;

	    }
	    );'
);


?>
<h1>Скоро следующая игра!</h1>

<div>
<?php
    if(isset($gameAccept)) {
        echo 'Название игры - ', $gameAccept->name . "";
        echo '<br> чуть-чуть про игру  - ', $gameAccept->description . "";
        $team = Team::model()->findByAttributes(array('id'=>$gameAccept->teamId));
        if(isset($team)) {
            echo '<br> Написано командой   - ', $team->name . "";
            echo '<br> Дата игры - ', $gameAccept->date . "";
        }else{
            echo 'Нет команды';
        }
    }else{
        echo 'Игр нет';
    }
?>
</div>

<br>

<button class="button_team">
    Заявки
</button>

<br>

<div class="team-form" style="display: none">

    <h1> Участники: </h1>

    <?php
        if(isset($teamList)) {
            echo "<ul>";
            foreach ($teamList as $team) {
                echo "<li>";
                echo $team->name;
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo 'заявок нет';
        }
    ?>

</div><!-- form -->
<br>
<div class="button_z">
    <?php
    if(check($teamList)===false){
        printButton1();
    } else {
        printButton2();
    }

    function printButton2(){
        echo '<button class="button_2" name="off">';
        echo 'Снять заявку';
        echo '</button>';
    }
    function printButton1() {
        echo '<button class="button_1" name="on">';
        echo 'Подать заявку';
        echo '</button>';
    }
    function check($teamList){
        if(isset($teamList)){
            foreach($teamList as $team){
                if(Yii::app()->user->id === $team->id){
                    return true;
                }
            }
        }
        return false;
    }
    ?>
</div>

<br>

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
                    $i=$grid->order;
                    echo "<td>";
                    echo  '<input name="order" type="text" size="4" value = '. $i.'>';
                    echo "</td>";
                }

            }
            echo "</tr>";
        }
     echo "</table>";
    }
 else {
     echo 'заданий нет';
 }
    echo CHtml::submitButton('Сохранить изменения'); ?>
</div>
