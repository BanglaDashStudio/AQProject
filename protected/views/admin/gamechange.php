<?php
/* @var $this AdminController */
/* @var $this gameArray */
/* @var $this gameArray */
$this->breadcrumbs=array(
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
            action="<?php echo Yii::app()->createUrl("Admin/ChangeId");?>"
            method="post"
            name="FormGame">

    <?php
        echo CHtml::dropDownList('listname', $gameActual, $gameArray, $htmlOptions=array());
    ?>
        <div class="row buttons">
            <input type="submit" value="Сделать игрой недели" class="pretty_submit" />
        </div>

    </form>

</div>

<div>
    <?php echo "<a href=".Yii::app()->createUrl("gamecrud/").">Редактор заявок</a>";?>
</div>