<?php

?>


<div class="gridform" style="">
    <form id="formforgrigform" action="<?php echo $this->createUrl('game/play'); ?>" method="post">
    <?php

    echo "<table border='1' style='border: solid'>";

    echo "<tr>";
    echo"<th>";
    echo '~~~';
    echo "</th>";
    $a = array(1,2,3,4);

    //заголовки - передать количество заданий
    for($i=1; $i<=$count_task; $i++) {
        echo"<th>";
        echo $i;
        echo "</th>";
    }

    echo"<th>";
    echo 'Статус';
    echo "</th>";

    echo "</tr>";


    for($j=0;$j<$count_task;$j++){

        echo '<tr>';

        //первый столбец
        echo "<td>";
        echo $teams[$j]->name;//перечислить названия тимов j - количество a[j] - название //передать тимы по геймтиму
        echo "</td>";

        for($i=1;$i<=$count_task;$i++) {

            $grid = Grid::model()->findByAttributes(array("teamId"=>$teams[$j]->id, "orderTask"=>$i, "gameId"=>$gameId));

            //если команда выполнила задание - выводим время, если нет - выводим прочерк
            echo "<td>";
            if ($grid->timeTask != null) {
                echo $grid->timeTask;
            }else {
                echo '-';
            }
            echo "</td>";
        }

        echo "<td>";

        $gameteam = Gameteam::model()->findByAttributes(array("teamId"=>$teams[$j]->id));
        if($gameteam->finish == 1){
            echo "финиш"; //TODO:: из result выводить сюда время
        }else{
            echo "Выполнено ";
            echo $gameteam->counter;
        }
        echo "</td>";

        echo '</tr>';
    }
    //echo "</tr>";
    echo "</table>";
?>
    </form>
</div>