<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<?if($user != NULL):?>
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
		<ul class="my_teams">
		<?foreach($teams as $team):?>
			<li>
				<?=$team->team->name;?> (<?=html::anchor('tournament/view/'.$team->table->url, $team->table->name);?>)
			</li>
		<?endforeach;?>
		</ul>
	<?endif;?>
<?else:?>
	<p>
		<?=html::anchor('login', 'Войдите')." на сайт"."<br>Или ".html::anchor('reg', 'зарегистрируйтесь');?>
	</p>
<?endif;?>