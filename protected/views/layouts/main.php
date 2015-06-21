<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<!--Аня пришла!-->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
    <!--[if lt IE 9]-->
    <script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <!--[endif]-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<script>
    function go(link){
        window.location.href = link;
    }
</script>

<div class="container" id="page">

	<!-- <div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div> -->

    <div id="header">
        <div id="logo"><?php
            echo "<a href=".Yii::app()->createUrl("home").">";
            echo CHtml::image("images/logo.png",NULL,array("height"=>225, "class"=>"logo", "title"=>"PTZAutoQuest", "alt"=>"PTZAutoQuest"));
            echo "</a>";
            ?>
        </div>
    </div><!-- header -->



	<nav class="nav">
		<?php
            if(Yii::app()->user->isAdmin()){
                $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'Главная', 'url'=>array('/home/'), 'id'=>'current'),
                    array('label'=>'Игра', 'url'=>array('/game/Play')),
                    array('label'=>'Управление командами', 'url'=>array('teamcrud/index')),
                    array('label'=>'Управление играми', 'url'=>array('admin/gamechange')),
                    array('label'=>'Личный кабинет', 'url'=>array('/pR/')),
                    array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/auth/logout')),
                ),
            ));
        }else{
            $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
				array('label'=>'Главная', 'url'=>array('/home/'), 'id'=>'current'),
			    array('label'=>'Вход', 'url'=>array('/auth/SignIn'),'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Регистрация', 'url'=>array('/auth/SignUp'),'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Игра', 'url'=>array('/game/Play'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Создать игру', 'url'=>array('/game/MyGames'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Личный кабинет', 'url'=>array('/pR/'),'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/auth/logout'), 'visible'=>!Yii::app()->user->isGuest),
            ),
		)); }?>
	</nav><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>  
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>
	

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by BanglaDashStudio.<br/>
		All Rights Reserved.<br/>
		<?php /*echo Yii::powered();
            echo "<br />";*/
            echo CHtml::link("PTZ AUTO QUEST Вконтакте","http://vk.com/ptz_qst");
        ?>

	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
