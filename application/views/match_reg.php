<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<?if($errors):?>
<div class="errors">
	<p class="errors">Произошла ошибка</p>
	<ul>
		<?foreach($errors as $error):?>
		<li>
			<?=$error?>
		</li>
		<?endforeach;?>
</ul>
</div>
<?endif;?>
<h2>Регистрация матча</h2>
<?=form::open();?>
<ul>
	<li>
		<label class="desc" for="away_id">
			Соперник
			<span class="req">*</span>
		</label>
		<div>
			<?=form::dropdown(array('name' => 'away_id', 'class' => 'select medium field'), $teams, $form['away_id'])?>
		</div>
	</li>
	<li class="">
		<label class="desc" for="last_name">
			Счёт
			<span class="req">*</span>
		</label>
		<div>
			<input class="field text medium" style="width:20%" type="text" name="home_goals" id="home_goals" value="<?=$form['home_goals']?>">
			:
			<input class="field text medium" style="width:20%" type="text" name="away_goals" id="away_goals" value="<?=$form['away_goals']?>">
<!--			<label for="last_name">От <b>2</b> до <b>30</b> символов</label>	-->
		</div>
	</li>
	<li>
		<input type="hidden" name="home_id" value="<?=$uteam->id;?>">
		<input type="submit" class="submit" value="Сохранить изменения">
	</li>
</ul>
<?=form::close();?>