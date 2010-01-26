<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<!--<div class="home_team_ava"><img src="/templates/template/img/bg_main.png" style="width: 100px; height: 100px;"></div>
<div class="match_result">4 : 1</div>
<div class="away_team_ava"><img src="/templates/template/img/bg_main.png" style="width: 100px; height: 100px;"></div>
-->

<table cellspacing="0" cellpadding="0" class="match">
	<tbody>
		<tr>
			<td class="home_team_ava">
				<?=html::image($match->home->team->img, array('class' => 'team_logo', 'alt' => $match->home->team->name));?>
			</td>
			<td class="match_result">
				<div class="match_tournament">
					<?=$match->table->name;?>
				</div>
				<div class="match_date">
					<?=misc::get_human_date($match->date);?>
				</div>
				<table class="match_teams">
					<tr>
						<td class="match_team_home"><?=$match->home->team->name;?></td>
						<td>-</td>
						<td class="match_away_home"><?=$match->away->team->name;?></td>
					</tr>
				</table>
<!--				<div class="match_teams">
					<?=$match->home->team->name;?>
					-
					<?=$match->away->team->name;?>
				</div> -->
				<?=$match->home_goals;?> : <?=$match->away_goals;?>
			</td>
			<td class="away_team_ava">
				<?=html::image($match->away->team->img, array('class' => 'team_logo', 'alt' => $match->away->team->name));?>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
				<ul class="home_goals">
				<?if($match->home_goals):?>
					<?foreach ($home_goals as $goal):?>
					<li><?=$goal->player->name();?> <?=misc::get_goals_images($goal->count);?></li>
					<?endforeach;?>
				<?endif;?>
				</ul>
				<ul class="away_goals">
				<?if($match->away_goals):?>
					<?foreach ($away_goals as $goal):?>
					<li><?=misc::get_goals_images($goal->count);?> <?=$goal->player->name();?></li>
					<?endforeach;?>
				<?endif;?>
				</ul>
			</td>
			<td>

			</td>
		</tr>
	</tbody>
</table>