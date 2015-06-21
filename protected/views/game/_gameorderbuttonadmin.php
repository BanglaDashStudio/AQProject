<?php
/* @var $teamList Team */
/* @var $gameAccept Game */


Yii::app()->clientScript->registerScript('button-on', '
$(".button1").click(
function(){
window.location.href = "'.$this->createUrl("game/lockOrder", array("gameId"=>$gameAccept->id)).'";
return false;
}
);

$(".button2").click(
function(){
window.location.href = "'.$this->createUrl("game/unlockOrder", array("gameId"=>$gameAccept->id)).'";
return false;
}
);');

?>

<?php
if(check($gameAccept)===false){
    printButton1();
} else {
    printButton2();
}

function printButton2(){
    echo '<button class="button2">';
    echo 'Открыть подачу заявок';
    echo '</button>';
}
function printButton1() {
    echo '<button class="button1">';
    echo 'Закрыть подачу заявок';
    echo '</button>';
}
function check($game){
    if(isset($game)){
        if($game->orderLock == 0) {
            return true;
        }
    }
    return false;
}
?>