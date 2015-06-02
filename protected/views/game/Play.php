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
    echo  'Название игры - ', $item->NameGame."";

        echo  '<br> чуть про игру  - ', $item->DescriptionGame."";
    }
?>

<div class="row buttons">
    <?php echo CHtml::submitButton('Подать завявку на игру!'); ?>
</div>



</p>
