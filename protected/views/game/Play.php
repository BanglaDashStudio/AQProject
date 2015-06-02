<?php
/* @var $this GameController */

$this->breadcrumbs=array(
	'Game'=>array('/game'),
	'Play',
);
?>
<h1>Скоро след. игра!</h1>

<?php
    foreach($model as $item){
    echo  'Название игры - ', $item->name."";

        echo  '<br> Дата игры  - ', $item->date."";
    }
?>

<div class="row buttons">
    <?php echo CHtml::submitButton('Подать завявку на игру!'); ?>
</div>



</p>
