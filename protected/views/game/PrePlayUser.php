<?php
/* @var $this GameController */
/* @var $gameAccept Game */
/* @var $teamList Team
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

