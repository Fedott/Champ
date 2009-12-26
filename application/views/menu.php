<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<p>
	<?=$user->username?> <?=html::anchor('logout', 'Выйти', array('class' => 'logout'));?>
</p>

<ul class="vmenu">
	<li><?=html::anchor('match', 'Матчи');?></li>
	<li><?=html::anchor('tournament', "Турниры");?></li>
</ul>

<?if(count($teams)):?>
<p>
	Ваши команды:
</p>
<ul>
<?foreach($teams as $team):?>
	<li>
		<?=$team->team->name;?> (<?=$team->table->name;?>)
	</li>
<?endforeach;?>
</ul>
<?endif;?>