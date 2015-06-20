<?php
/* @var $this GameController */
/* @var $gameAccept Game */
/* @var $teamList Team */
/* @var $taskList Task */
/* @var $gridOrder Grid
 */

?>

<hr />

<div>
    <?php $this->renderPartial('_gameinfo', array('gameAccept'=>$gameAccept)); ?>
</div>

<hr />

<div>
    <?php $this->renderPartial('_gameorder', array('teamList'=>$teamList, 'gameAccept'=>$gameAccept)); ?>
</div>

<hr />

<div>
    <?php $this->renderPartial('_gamegrid', array(
                                            'teamList'=>$teamList,
                                            'taskList'=>$taskList,
                                            'gridOrder'=>$gridOrder
    ));
    ?>
</div>
