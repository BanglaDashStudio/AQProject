<?php
/* @var $teamList Team */

if(isset($teamList)) {
    Yii::app()->clientScript->registerScript('teamlist', "
$('.button_team').click(function(){
	$('.team-form').toggle();
	return false;
});
");
}

?>


<button class="button_team">
    <?php
    if (isset($teamList)) {
        echo 'Заявки: ';
        echo count($teamList);
    }else{
        echo 'Заявок нет';
    }
    ?>
</button>

<br>

<div class="team-form" style="display: none">
    <?php
    if(isset($teamList)) {
        echo "<ul>";
        foreach ($teamList as $team) {
            echo "<li>";
            echo $team->name;
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo 'заявок нет';
    }
    ?>

</div><!-- form -->