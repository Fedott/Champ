<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<p>Подтвердите удаление матча:<br>
<?=$match->home->team->name." <b>".$match->home_goals." - ".$match->away_goals."</b> ".$match->away->team->name;?><br>
<?if(count($home_goals)):?>
Голы хозяев:
<?foreach($home_goals as $goal):?>
<?=$goal->player->name()." - ".$goal->count?><br>
<?endforeach;?>
<?endif;?>
<?if(count($away_goals)):?>
Голы гостей:<br>
<?foreach($away_goals as $goal):?>
<?=$goal->player->name()." - ".$goal->count?><br>
<?endforeach;?>
<?endif;?>
</p>
<p>
	<?=html::anchor('match/delete_confirm/'.$match->id, 'Удалить');?>
	|
	<?=html::anchor('match', 'Отмена');?>
</p>