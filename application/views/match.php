<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h2>Ваши матчи</h2>
<?if(count($uncmatches)):?>
<h3>Не подтверждённые матчи</h3>
<ul>
<?foreach($uncmatches as $match):?>
	<li><?=html::anchor('match/confirm/'.$match->id, $match->home->team->name." ".$match->home_goals." - ".$match->away_goals." ".$match->away->team->name);?></li>
<?endforeach;?>
</ul>
<?endif;?>
<?if(count($matches) || count($matches_a)):?>
<h3>Подтверждённые матчи</h3>
<ul>
<?foreach($matches as $match):?>
	<li><?=$match->home->team->name." ".$match->home_goals." - ".$match->away_goals." ".$match->away->team->name;?></li>
<?endforeach;?>
<?foreach($matches_a as $match):?>
	<li><?=$match->home->team->name." ".$match->home_goals." - ".$match->away_goals." ".$match->away->team->name;?></li>
<?endforeach;?>
</ul>
<?endif;?>