<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h1><?=$tournament->name?></h1>
<?if(count($tournament->lines)):?>
<p>Команды учавствующие в турнире:</p>
<ul>
	<?foreach($tournament->lines as $key => $line):?><li><?=html::anchor('admin/team/view/'.$line->team->id, $line->team->name)?></li><?endforeach;?>
</ul>
<?else:?>
<p>
	Турнир пока пуст
</p>
<?endif?>
<hr>
<?=html::anchor('admin/tournament/edit/'.$tournament->id, 'Редактировать')?>
<br>
<?=html::anchor('admin/tournament/adds/'.$tournament->id, 'Добавить команды')?>