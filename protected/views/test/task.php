<?php
/**
 * Created by PhpStorm.
 * User: theantonysurikoff
 * Date: 26.06.15
 * Time: 8:03
 */

/* @var taskId */
/* @var task Task */

?>

<hr />
Задание
<hr />
<p>что-то для ввода задания</p>
<button>Загрузить файлы</button> <br />
<hr />


Подсказки
<hr />
<div id="hintList">
    <div>
        <input name="hint[0]" type="textarea" />
        <button>Загрузить файлы</button> <br />
    </div>
</div>
<button id="addHint">Добавить еще поле для подсказки</button>
<hr />

<hr />
Коды
<hr />
<input type="hidden" id="counter_box" style="display:none;" />

<ul id="codeList">
        <li>
            <input type="text" name="code[0]" placeholder="Insert Code" />
        </li>
</ul>

    <button id="addCode">Добавить код</button><br />
<hr />


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

    var hint_counter = 1;
    var hint_amount = 1;

    function addHint(){
        if(hint_amount >= 5){
            alert('Не больше 5 подсказок для задания!');
            return;
        }

        var list = $('#hintList');
        var del = $('<button>Удалить</button>');
        var input = $('<input type="textarea" name="hint['+counter+']" placeholder="Insert Hint" />');
        var item = $("<div></div>");
        var count = $('#counter_box_hint');

        hint_counter++;
        hint_amount++;

        count.text(counter);

        del.on('click',deleteCode);

        item.append(input);
        item.append(del);
        list.append(item);
    }

    function addCode(){
        if(amount >= 10){
            alert('Не больше 10 кодов для задания!');
            return;
        }

        var list = $('#codeList');
        var del = $('<button>Удалить</button>');
        var input = $('<input type="text" name="code['+counter+']" placeholder="Insert Code" />');
        var item = $("<li></li>");
        var count = $('#counter_box');

        counter++;
        amount++;

        count.text(counter);

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