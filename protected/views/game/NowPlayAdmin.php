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
    <form id="formforstopform" action="<?php echo $this->createUrl('game/stopGame');?>">
        <input type="submit" class="StopGameButton" value="Закончить игру"/>
    </form>
</div>