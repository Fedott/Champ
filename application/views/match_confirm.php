<?php defined('SYSPATH') OR die('No direct access allowed.');?>
Вы подтверждаете результат матча: <?=$match->home->team->name." ".$match->home_goals." - ".$match->away_goals." ".$match->away->team->name;?>?
<br>
<?=html::anchor('match/confirm_ok/'.$match->id, 'Да');?> | <?=html::anchor('match', 'Нет');?>