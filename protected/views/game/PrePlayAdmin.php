<?php
/* @var $this GameController */
/* @var $gameAccept Game */
/* @var $teamList Team */
/* @var $taskList Task */
/* @var $gridOrder Grid
 */
?>


<div>
    <?php
        $this->renderPartial('_gameinfo', array('gameAccept' => $gameAccept));
    ?>
</div>

<br>

<div>
    <?php
    if(isset($gameAccept)){
        $this->renderPartial('_gameorder', array('teamList'=>$teamList, 'gameAccept'=>$gameAccept));
    } ?>
</div>

<br>

<div>
    <?php if(isset($gameAccept)){
        $this->renderPartial('_gameorderbuttonadmin', array('gameAccept'=>$gameAccept));
    } ?>
</div>

<br>

<div>
    <?php if(isset($gameAccept)){
        $this->renderPartial('_gamegrid', array(
            'teamList'=>$teamList,
            'taskList'=>$taskList,
            'media'=>$media,
            'gridOrder'=>$gridOrder
        ));
    }
    ?>
</div>
