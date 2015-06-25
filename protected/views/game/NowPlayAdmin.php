<?php
/* @var $this GameController */
/* @var $model Code */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript('button-on', '
$(".button").click(
function(){
if (confirm("Вы уверены?")) {
window.location.href = "'.$this->createUrl("game/stopGame").'";
}
return false;
}
);'
);

?>

<div class="gridform">
    сетка
</div>




<div class="stopform" >
    <form id="formforstopform" >
        <button class="button">
            закончить игру
        </button>
    </form>
</div>