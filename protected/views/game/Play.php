<?php
/* @var $this GameController */

Yii::app()->clientScript->registerScript('teamlist', "
$('.button_team').click(function(){
	$('.team-form').toggle();
	return false;
});
");
?>
<h1>Скоро след. игра!</h1>

<div>
<?php
    if(isset($model)) {
        echo 'Название игры - ', $model->NameGame . "";
        echo '<br> чуть-чуть про игру  - ', $model->DescriptionGame . "";
    }else{
        echo 'Игр нет';
    }
?>
</div>

<br>

<button class="button_team">
    Команды, подавшие заявку
</button>

<br>

<div class="team-form">

    <h1> Участники: </h1>

    <?php
        if(isset($teamList)) {
            echo "<ul>";
            foreach ($teamList as $team) {
                echo "<li>";
                echo $team->NameTeam;
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo 'заявок нет';
        }
    ?>

</div><!-- form -->
<br>

<button>
    Подать завявку на игру!
</button>


