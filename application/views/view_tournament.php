<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h1><?=$tournament->name;?></h1>
<table cellpadding="3" cellspacing="1">
	<thead>
		<tr>
			<th>№</th>
			<th>Команда</th>
			<th>Побед</th>
			<th>Поражений</th>
			<th>Набрано</th>
			<th>Потеряно</th>
		</tr>
	</thead>
	<?foreach ($tournament->lines as $line):?>
	<tr class="<?=(($i%2)==0)?'chet':'nechet'?>">
		<td><?=$i++?></td>
		<td><?=$line->team->name?></td>
		<td><?=$line->win?></td>
		<td><?=$line->lose?></td>
		<td><?=$line->win_points?></td>
		<td><?=$line->lose_points?></td>
	</tr>
	<?endforeach;?>
</table>