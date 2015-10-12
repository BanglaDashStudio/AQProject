<?php
/* @var $teamList Team */
/* @var $gameAccept Game */

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

<div class="button_z">
    <?php
    if($gameAccept->orderLock==1){
        if(check($teamList)===false){
            printButton1();
        } else {
            printButton2();
        }
    } else {
        echo '<h4>Подача заявок завершена</h4>';
    }

    function printButton2(){
        echo '<button class="button_2 pretty_button" name="off">';
        echo 'Снять заявку';
        echo '</button>';
    }
    function printButton1() {
        echo '<button class="button_1 pretty_button" name="on">';
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