<?php
/* @var $this AdminController */
/* @var $this gameArray */
$this->breadcrumbs=array(
    'Главная админка'=>array('index'),
    'Управление играми',
);
?>

<div>
    <?php
         echo $gameActual;
    ?>
</div>

<div class="form">
    <form
            action="<?php echo Yii::app()->createUrl("Admin/Teamchange");?>"
            method="POST"
            name="FormGame"
        >

    <?php
        echo CHtml::dropDownList('listname', 0,
        $gameArray);
    ?>
    </form>

    <div class="row buttons">
        <input type="submit" value="Сделать игрой недели">

        </input>
    </div>

</div>

<div>
    <?php echo "<a href=".Yii::app()->createUrl("gamecrud/").">Редактор заявок</a>";?>
</div>