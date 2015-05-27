<?php
/* @var $this PRController */
/* @var $Password PRPassword */

Yii::app()->clientScript->registerScript('search', "
$('.password-button').click(function(){
	$('.password-form').toggle();
	return false;
});
");

?>
<h1><?php echo Yii::app()->user->name; ?></h1>

<?php echo CHtml::link('Изменить пароль','#',array('class'=>'password-button')); ?>

<div class="password-form" style="display:none">
<?php $this->renderPartial('_prpassword', array('model'=>$Password)); ?>
</div>

