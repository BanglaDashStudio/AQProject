<?php
/* @var $teamList Team */
/* @var $taskList Task */
/* @var $gridOrder Grid
 */

Yii::app()->clientScript->registerScript('grid', "
$('.grid_button').click(function(){
	$('.gridform').toggle();
	return false;
});
");
?>


<button class="grid_button">
    Сетка
</button>

<div class="gridform" style="display: none">
    <form id="formforgrigform" action="<?php echo $this->createUrl('game/play'); ?>" method="post">
    <?php

    if(isset($taskList) && isset($teamList) && isset($gridOrder)) {
        echo "<table border='1'>";

        echo "<tr>";
        echo"<th>";
        echo '~~~';
        echo "</th>";
        foreach ($taskList as $task) {
            echo"<th>";
            echo $task->name;
            echo "</th>";
        }
        echo "</tr>";

        foreach ($teamList as $team) {
            echo "<tr>";
            echo "<td>";
            echo $team->name;
            echo "</td>";

            foreach ($gridOrder as $grid) {
                if ($grid->teamId == $team->id) {
                    $i=$grid->orderTask;
                    echo "<td>";
                    echo  '<input ';
                    echo 'name="GridForm['. $team->id . ' : ' . $grid->taskId .']"';
                    echo 'type="text" class="grid_cell" size="3" value = '. $i.'>';
                    echo "</td>";
                }
            }
            echo "<td>";
            echo  '<label class="gridErrorLabel">';
            echo '</label>';
            echo "</td>";
            echo "</tr>";

            if (!isset($gridOrder))
            {
                echo "<td>";
                echo  '<input';
                echo 'name="GridForm['. $team->id . ' : ' . $grid->taskId .']"';
                echo 'type="text" class="grid_cell" size="4" value = '.' '.'>';
                echo "</td>";

            }


        }
        echo "</table>";
    }
    else {
        echo 'заданий нет';
    }
    echo '<br />';
    echo CHtml::submitButton('Сохранить изменения', array('id'=>'gridSubmit', 'class'=>'pretty_submit')); ?>



    </form>

    <script>
        $('.grid_cell').on("change", checkCell);

        function checkCell() {
            var obj = $(this);

            if (obj.val() < 0) {
                obj.val(0);
            }

            if (obj.val() > <?php echo count($taskList);?>) {
                obj.val(0);
            }

            checkAll();
        }

        function checkAll(){
            var rowsSize = <?php echo count($taskList);?>;
            var rowsAmount = <?php echo count($teamList);?>;
            var summa = 0;

            var error = false;

            for(var i = 1; i <= rowsSize;i++){
                summa += i;
            }

            for (var row = 0; row < rowsAmount;row++) {
                var sum = summa;

                for(var col = 0; col < rowsSize;col++) {
                    var obj = $('.grid_cell:eq('+(row*rowsSize+col)+')');
                    sum = sum - Number(obj.val());
                }

                if(sum != 0) {
                    $('.gridErrorLabel:eq('+row+')').text("Ошибка!");
                    error = true;
                } else {
                    $('.gridErrorLabel:eq('+row+')').text("");
                }
            }

            if(error){
                $('#gridSubmit').attr('disabled', true);
            } else {
                $('#gridSubmit').attr('disabled', false);
            }
        }

    </script>
</div>