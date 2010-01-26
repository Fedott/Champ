<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<?if($tourn->loaded):?>
<h2><?=$tourn->name;?></h2>
<?else:?>
<h2>Все матчи</h2>
<?endif;?>
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
	<?foreach($matches as $match):?>
		<tr class="<?=((++$i%2)==0)?'chet':'nechet'?><?=($match->away->user_id == $this->user->id)?' my_team':'';?>">
			<td><?=html::anchor('/tournament/team/'.$match->home_id, $match->home->team->name);?></td>
			<td><?=html::anchor('match/view/'.$match->id, $match->home_goals." - ".$match->away_goals);?></td>
			<td><?=html::anchor('/tournament/team/'.$match->away_id, $match->away->team->name);?></td>
			<td><?=misc::get_human_date($match->date);?></td>
		</tr>
	<?endforeach;?>
	</tbody>
</table>
<?=$this->pagination;?>