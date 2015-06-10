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
window.location.href = "'.$this->createUrl("game/newOrder", array("IdGame"=>$model->IdGame, "IdTeam"=>Yii::app()->user->id)).'";
}
return false;
}
);
$(".button_2").click(
function(){
if (confirm("Вы уверены?")) {
window.location.href = "'.$this->createUrl("game/deleteOrder", array("IdGame"=>$model->IdGame, "IdTeam"=>Yii::app()->user->id)).'";
}
return false;
}
);'
);


Yii::app()->clientScript->registerScript('button-on', '

        $(".button_1").click(
        function(){
            if (confirm("Вы уверены?")) {
                window.location.href = "'.$this->createUrl("game/newOrder", array("IdGame"=>$model->IdGame, "IdTeam"=>Yii::app()->user->id)).'";
            }
            return false;
	    }
	    );

	    $(".button_2").click(
	    function(){

            if (confirm("Вы уверены?")) {
                window.location.href = "'.$this->createUrl("game/deleteOrder", array("IdGame"=>$model->IdGame, "IdTeam"=>Yii::app()->user->id)).'";
            }
            return false;

	    }
	    );'
);


?>
<h1>Скоро след. игра!</h1>

<div>
<?php
    if(isset($model)) {
        echo 'Название игры - ', $model->NameGame . "";
        echo '<br> чуть-чуть про игру  - ', $model->DescriptionGame . "";
        $team = Team::model()->findByAttributes(array('IdTeam'=>$model->IdTeam));
        echo '<br> Написано командой   - ', $team->NameTeam . "";
        echo '<br> Дата игры - ', $model->Date . "";
    }else{
        echo 'Игр нет';
    }
?>
</div>

<br>

<button class="button_team">
    Команды, подавшие заявку
</button>

<br>

<div class="team-form" style="display: none">

    <h1> Участники: </h1>

    <?php
        if(isset($teamList)) {
            echo "<ul>";
            foreach ($teamList as $team) {
                echo "<li>";
                echo $team->NameTeam;
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
                if(Yii::app()->user->id == $team->IdTeam){
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
         echo $task->DescriptionTask;
         echo "</th>";
        }
     echo "</tr>";

        foreach ($teamList as $team) {
            echo "<tr>";
            echo "<td>";
            echo $team->NameTeam;
            echo "</td>";

            foreach ($gridOrder as $grid) {
                if ($grid->IdTeam == $team->IdTeam) {
                    $i=$grid->Order;
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
