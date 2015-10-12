<?php
/* @var $this GameController */
/* @var $model Code */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript('stopGameButton', '
$(".StopGameButton").click(
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


<div>
    <?php
        $this->renderPartial('_nowplayadmingrid', array(
            'count_task'=>$count_task,
            'teams'=>$teams,
            'gameId'=>$gameId,
        ));

    ?>
</div>




<div class="stopform" >
        <button class="StopGameButton pretty_red_button">Закончить игру</button>
</div>
