<?php
/* @var $teamList Team */
/* @var $gameAccept Game */

Yii::app()->clientScript->registerScript('teamlist', "
$('.button_team').click(function(){
	$('.team-form').toggle();
	return false;
});
");

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