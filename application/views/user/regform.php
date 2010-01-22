<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h2>Регистрация</h2>
<?if($errors):?>
<div class="errors">
	Вы допустили следующие ошибки:
	<ul>
		<?foreach($errors as $error):?>
		<li>
			<?=$error?>
		</li>
		<?endforeach;?>
</ul>
</div>
<?endif;?>
<?=form::open();?>
<ul>
	<li class="">
		<label class="desc" for="username">
			Логин
			<span class="req">*</span>
		</label>
		<div>
			<input class="field text medium" type="text" name="username" id="username" value="<?=$form['username']?>">
			<label for="username">От <b>4</b> до <b>20</b> символов</label>
		</div>
	</li>
	<li class="">
		<label class="desc" for="password">
			Пароль
			<span class="req">*</span>
		</label>
		<div>
			<input class="field text medium" type="password" name="password" id="password">
			<label for="password">От <b>6</b> до <b>20</b> символов</label>
		</div>
	</li>
	<li class="">
		<label class="desc" for="password_confirm">
			Подтверждение пароля
			<span class="req">*</span>
		</label>
		<div>
			<input class="field text medium" type="password" name="password_confirm" id="password_confirm">
			<label for="password_confirm">От <b>6</b> до <b>20</b> символов</label>
		</div>
	</li>
	<li class="">
		<label class="desc" for="email">
			E-mail
			<span class="req">*</span>
		</label>
		<div>
			<input class="field text medium" type="text" name="email" id="email" value="<?=$form['email']?>">
		</div>
	</li>
	<li class="">
		<label class="desc" for="icq">
			ICQ
			<span class="req">*</span>
		</label>
		<div>
			<input class="field text medium" type="text" name="icq" id="icq" maxlength="12" value="<?=$form['icq']?>">
			<label for="icq">Только цифры</label>
		</div>
	</li>
	<li class="">
		<label class="desc" for="first_name">
			Имя
		</label>
		<div>
			<input class="field text medium" type="text" name="first_name" id="firs_name" maxlength="30" value="<?=$form['first_name']?>">
		</div>
	</li>
	<li class="">
		<label class="desc" for="last_name">
			Фамилия
		</label>
		<div>
			<input class="field text medium" type="text" name="last_name" id="last_name" maxlength="30" value="<?=$form['last_name']?>">
		</div>
	</li>
	<li class="">
		<label class="desc" for="www">
			WWW
		</label>
		<div>
			<input class="field text medium" type="text" name="www" id="www" value="<?=$form['www']?>">
		</div>
	</li>
	<li class="">
		<label class="desc" for="like_club">
			Любимый клуб
		</label>
		<div>
			<input class="field text medium" type="text" name="like_club" id="like_club" maxlength="50" value="<?=$form['like_club']?>">
		</div>
	</li>
	<li class="">
		<label class="desc" for="like_player">
			Любимый игрок
		</label>
		<div>
			<input class="field text medium" type="text" name="like_player" id="like_player" maxlength="50" value="<?=$form['like_player']?>">
		</div>
	</li>
	<li>
		<input type="submit" class="submit" value="Зарегистрироваться">
	</li>
</ul>
<?=form::close();?>
