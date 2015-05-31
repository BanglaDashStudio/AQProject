<?php
/* @var $this AdminController */

?>
<h1><?php echo "Привет, Админ!" ?></h1>

<div>
<?php echo "<a href=".Yii::app()->createUrl("team").">Управление командами</a>";?>
</div>

<div>
<?php echo "<a href=".Yii::app()->createUrl("gamecrud").">Управление играми</a>";?>
</div>