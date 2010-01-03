<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h2>Турниры:</h2>
<table cellpadding="3" cellspacing="1">
	<thead>
		<tr>
			<th>№</th>
			<th>Название</th>
			<th>Команды участники</th>
		</tr>
	</thead>
	<?foreach($tournaments as $tournament):?>
		<?$ii = 0;?>
		<tr class="<?=(($i%2)==0)?'chet':'nechet'?>">
			<td><?=$i++?>.</td>
			<td><?=html::anchor('/tournament/view/'.$tournament->url, $tournament->name, array('class' => 'tournament'))?></td>
			<td><?foreach($tournament->lines as $line):?><?=(++$ii!=1)?', ':''?><?=$line->team->name?><?endforeach;?></td>
		</tr>
	<?endforeach;?>
</table>