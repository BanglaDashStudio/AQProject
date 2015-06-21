<?php
/* @var $gameAccept Game */
?>


<h1>
    <?php
    if(!isset($gameAccept)){
        echo 'Игра не выбрана';
    }
    ?>
</h1>

<div>
    <?php
    if(isset($gameAccept)) {
        echo 'Название игры - ', $gameAccept->name . "";
        echo '<br> чуть-чуть про игру  - ', $gameAccept->description . "";
        $team = Team::model()->findByAttributes(array('id'=>$gameAccept->teamId));
        if(isset($team)) {
            echo '<br> Написано командой   - ', $team->name . "";
            echo '<br> Дата игры - ', $gameAccept->date . "";
        }else{
            echo 'Нет команды';
        }
    }
    ?>
</div>