<?php
/* @var $this GameController */
/* @var $model Code */
/* @var $form CActiveForm */
?>

<div class="playform" >
    <form id="formforplayform" action="<?php echo $this->createUrl('game/play'); ?>" method="post">

        Вы завершили игру!
        <br />
        Количество сделанных заданий: <?php echo $gameteam->counter; ?>

    </form>
</div>