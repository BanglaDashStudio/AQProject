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

<br>

<div>
    <?php if(isset($gameAccept)){
        $this->renderPartial('_gameorder', array('teamList'=>$teamList));
    } ?>
</div>

<br>

<div>
    <?php if(isset($gameAccept)){
        $this->renderPartial('_gameorderbuttonuser', array('teamList'=>$teamList, 'gameAccept'=>$gameAccept));
    } ?>
</div>

