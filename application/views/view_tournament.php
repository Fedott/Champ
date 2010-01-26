<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h1><?=$tournament->name;?></h1>
<table cellpadding="3" cellspacing="1">
	<thead>
		<tr>
			<th>№</th>
			<th>Команда</th>
			<th>Матчей</th>
			<th>Побед</th>
			<th>Ничьих</th>
			<th>Поражений</th>
			<th>Забито</th>
			<th>Пропущено</th>
			<th>Разница</th>
			<th>Очков</th>
		</tr>
	</thead>
	<?foreach ($tournament->lines as $line):?>
	<tr class="<?=(($i%2)==0)?'chet':'nechet'?><?=($line->user_id == $this->user->id)?' my_team':'';?>">
		<td><?=$i++?></td>
		<td><?=html::anchor('tournament/team/'.$line->id, $line->team->name);?></td>
		<td><?=$line->games;?></td>
		<td><?=$line->win?></td>
		<td><?=$line->drawn?></td>
		<td><?=$line->lose?></td>
		<td><?=$line->goals?></td>
		<td><?=$line->passed_goals?></td>
		<td><?=$line->goals - $line->passed_goals?></td>
		<td><?=$line->points?></td>
	</tr>
	<?endforeach;?>
</table>
<?=html::anchor('match/listen/'.$tournament->url, 'Матчи в рамках турнира');?>
<?if($uchastie):?>
<hr>
<?=html::anchor('match/reg/'.$tournament->id, 'Зарегистрировать матч');?>
<?endif;?>