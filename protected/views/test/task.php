<?php
/**
 * Created by PhpStorm.
 * User: theantonysurikoff
 * Date: 26.06.15
 * Time: 8:03
 */

/* @var task Task */
/* @var gameId */
/* @var codes Array $i=>Code */
/* @var hints Array $i=>Hint */
/* @var media_task */

?>
<div class="form">
<form action="<?php echo $this->createUrl('saveTask',array('gameId'=>$gameId))?>" method="post">

<label>Задание</label>
<hr />

<?php
    if(isset($task)) {
        echo '<input type="hidden" name="task[id]" ';
        echo 'value="' . $task->id . '"';
        echo ' style="display:none;" />';
    }
?>

<label>Название:</label>
<input type="text" name="task[name]" placeholder="Insert task name" />
<br />
<label>Адрес:</label>
<input type="text" name="task[address]" placeholder="Insert task name" />
<br />
<label>Описание:</label>
<textarea name="task[description]" placeholder="Insert task description" ></textarea>

<hr />

<label>Подсказки</label>
<hr />
<input type="hidden" name="hint_amount" style="display:none;" />

    <div id="hintList">

    </div>
    <input type="button" id="addHint" value="Добавить еще поле для подсказки" />


<hr />

<label>Коды</label>
<hr />
<input type="hidden" name="code_amount" style="display:none;" value="1" />

<div id="codeList">
        <div>
            <input type="text" name="task[code][0]" placeholder="Insert Code" />
        </div>
</div>

    <input type="button" id="addCode" value="Добавить код" /><br />
<hr />


    <input type="submit" value="Сохранить"/>
</form>
</div>
        <?php
        //там снизу jquery. страшное-страшное jquery.
        //там добавляются элементы в список кодов
        //инпут и кнопка удаления на каждый элемент списка
        //каждому инпуту ставится name=code[i]
        //i - постоянно уеличивается и передается выше, в hidden input
        ?>
<script>
    $('#addCode').on('click', addCode);
    $('#addHint').on('click', addHint);

    var counter = 1;
    var amount = 1;

    var hint_counter = 0;
    var hint_amount = 0;

    function addHint(){
        if(hint_amount >= 5){
            alert('Не больше 5 подсказок для задания!');
            return;
        }

        var list = $('#hintList');
        var del = $('<input type="button" value="Удалить" />');
        var input = $('<textarea name="task[hint]['+hint_counter+']" placeholder="Insert Hint" /><br />');
        var up_button = $('<input type="button" value="Загрузить файлы" />')
        var item = $("<div></div>");
        var count = $('[name = hint_amount]');

        hint_counter++;
        hint_amount++;

        count.val(hint_counter);

        del.on('click',deleteHint);

        item.append(input);
        item.append(up_button);
        item.append(del);
        list.append(item);
    }

    function deleteHint(){
        $(this).parent().remove();
        hint_amount--;
    }

    function addCode(){
        if(amount >= 10){
            alert('Не больше 10 кодов для задания!');
            return;
        }

        var list = $('#codeList');
        var del = $('<input type="button" value="Удалить" />');
        var input = $('<input type="text" name="task[code]['+counter+']" placeholder="Insert Code" />');
        var item = $("<div></div>");
        var count = $('[name = code_amount]');

        counter++;
        amount++;

        count.val(counter);

        del.on('click',deleteCode);

        item.append(input);
        item.append(del);
        list.append(item);
    }

    function deleteCode(){
        $(this).parent().remove();
        amount--;
    }

</script>