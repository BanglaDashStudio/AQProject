<?php
/* @var $this ManualTestingToolsController */
/* @var $gameList*/

$this->breadcrumbs=array(
	'Manual Testing Tools',
);

$gameList = Game::model()->findAll();

?>

<label>Сменить пользователя:</label>
<hr />

<ul>
	<li><a href="<?php echo $this->createUrl('manualTestingTools/UserChange',array('user'=>'admin'));?>">Администратор</a></li>
	<li><a href="<?php echo $this->createUrl('manualTestingTools/UserChange',array('user'=>'ухо'));?>">Ухо(горло)</a></li>
</ul>

<form action="<?php echo $this->createUrl('manualTestingTools/UserChangeWithPassword');?>" method="post">
	<div class="row">
	<input type="text" name="ManualTestingTools[user]" placeholder="Имя" class="pretty_input_text"/>
	</div>
	<div class="row">
	<input type="password" name="ManualTestingTools[pass]" placeholder="Пароль" class="pretty_input_text" />
	</div>
	<input type="submit" value="Войти" class="pretty_submit" />
</form>

<hr />
<br />

<label>Работа с игрой:</label>
<hr />
<form action="<?php echo $this->createUrl('manualTestingTools/GameStartChange');?>" method="post">
	<label>Начало игры через</label>
	<select name="ManualTestingTools[gameStart]">
		<option>1</option>
		<option selected>2</option>
		<option>3</option>
		<option>5</option>
		<option>10</option>
		<option>30</option>
	</select>
	<label>минут</label>
	<input type="submit" value="Установить" class="pretty_submit" />
</form>
<br />
<form action="<?php echo $this->createUrl('manualTestingTools/GameChange');?>" method="post">

	<label>Выбрать игру:</label>
	<select name="ManualTestingTools[game]">
	<?php
		foreach($gameList as $game){
			if($game->accepted == 1){
				echo '<option selected';
			} else {
				echo '<option';
			}

			echo ' value="'.$game->id.'">';
			echo $game->name;
			echo "</option>\n";
		}
	?>
	</select>

	<input type="submit" value="Установить" class="pretty_submit"/>
</form>

<hr />
