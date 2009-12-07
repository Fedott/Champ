<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<p>
	<?=$user->username?> <?=html::anchor('logout', 'Выйти', array('class' => 'logout'));?>
</p>
<?if(count($teams)):?>
<p>
	Ваши команды:
</p>
<ul class="menu_teams">
<?foreach($teams as $team):?>
	<li>
		<?=$team->team->name;?> (<?=$team->table->name;?>)
	</li>
<?endforeach;?>
</ul>
<?endif;?>