<?php
/* @var $this PRController */
/* @var $Password PRPassword */
/* @var $Info PRInfo */

Yii::app()->clientScript->registerScript('search', "
$('.password-button').click(function(){
	$('.password-form').toggle();
	return false;
});
");

?>
<h1><?php echo Yii::app()->user->name; ?></h1>

<?php
//TODO: есть баг со сварачиванием окна смены пароля, он бесит
echo CHtml::link('Изменить пароль','#',array('class'=>'password-button')); ?>

<div class="password-form" style="display:none">
<?php $this->renderPartial('_prpassword', array('model'=>$Password)); ?>
</div>

<?php $this->renderPartial('_prinfo', array('model'=>$Info)); ?>