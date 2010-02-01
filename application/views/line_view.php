<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h1><?=$line->team->name;?></h1>
<p>Турнир: <?=html::anchor('/tournament/view/'.$line->table_id, $line->table->name);?></p>
<p>Тренер: <?=$line->user->first_name." ".$line->user->last_name." (".$line->user->username.")";?> ICQ: <?=$line->user->icq;?></p>
<table class="season_info">
	<tbody>
		<tr>
			<td>Матчей:</td>
			<td><?=$line->games;?></td>
		</tr>
		<tr>
			<td>Очков:</td>
			<td><?=$line->points;?></td>
		</tr>
		<tr>
			<td>Выйграно</td>
			<td><?=$line->win;?></td>
		</tr>
		<tr>
			<td>Ничьих:</td>
			<td><?=$line->drawn;?></td>
		</tr>
		<tr>
			<td>Проиграно:</td>
			<td><?=$line->lose;?></td>
		</tr>
		<tr>
			<td>Забито:</td>
			<td><?=$line->goals;?></td>
		</tr>
		<tr>
			<td>Пропущено</td>
			<td><?=$line->passed_goals;?></td>
		</tr>
	</tbody>
</table>

<?if(count($goleodors)):?>
<h4>Бамбардиры команды</h4>
<table cellpadding="3" cellspacing="1">
	<thead>
		<tr>
			<th>№</th>
			<th>Имя</th>
			<th>Забито</th>
		</tr>
	</thead>
	<tbody>
		<?$i = 1;?>
		<?foreach ($goleodors as $lin):?>
		<tr class="<?=(($i%2)==0)?'chet':'nechet'?>">
			<td><?=$i++;?></td>
			<td><?=$lin['player']->name(NULL);?></td>
			<td><?=$lin['goals'];?></td>
		</tr>
		<?endforeach;?>
	</tbody>
</table>
<?else:?>
<p>Ещё не забито ни одного гола</p>
<?endif;?>

<h4>Матчи команды</h4>
<table class="matches" cellpadding="3" cellspacing="1">
	<thead>
		<tr>
			<th>Домашняя команда</th>
			<th>Счёт</th>
			<th>Гостевая команды</th>
			<th>Дата</th>
		</tr>
	</thead>
	<tbody>
	<?$i = 0;?>
	<?foreach($hm as $match):?>
		<tr class="<?=((++$i%2)==0)?'chet':'nechet'?><?=($match->away->user_id == $this->user->id)?' my_team':'';?>">
			<td><?=html::anchor('/tournament/team/'.$match->home_id, $match->home->team->name);?></td>
			<td><?=html::anchor('match/view/'.$match->id, $match->home_goals." - ".$match->away_goals);?></td>
			<td><?=html::anchor('/tournament/team/'.$match->away_id, $match->away->team->name);?></td>
			<td><?=misc::get_human_date($match->date);?></td>
		</tr>
	<?endforeach;?>
	<?foreach($am as $match):?>
		<tr class="<?=((++$i%2)==0)?'chet':'nechet'?><?=($match->home->user_id == $this->user->id)?' my_team':'';?>">
			<td><?=html::anchor('/tournament/team/'.$match->home_id, $match->home->team->name);?></td>
			<td><?=html::anchor('match/view/'.$match->id, $match->home_goals." - ".$match->away_goals);?></td>
			<td><?=html::anchor('/tournament/team/'.$match->away_id, $match->away->team->name);?></td>
			<td><?=misc::get_human_date($match->date);?></td>
		</tr>
	<?endforeach;?>
	</tbody>
</table>