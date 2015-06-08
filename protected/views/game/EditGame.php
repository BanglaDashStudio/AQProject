<?php
/* @var $this GameController */
/* @var $Game GameCreate */
/* @var $Task TaskCreateForm*/

?>
<?php $this->renderPartial('EditName', array('model'=>$GameCreate, 'idG' => $idG)); ?>

<?php $this->renderPartial('TaskList', array('TaskList'=>$Task, 'idG' => $idG) ); ?>
