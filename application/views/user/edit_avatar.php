<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<?=html::image($user->get_avatar());?>
<hr>
<?=form::open_multipart();?>
	<?=form::upload('picture');?>
	<?=form::submit('submit', 'Изменить');?>
<?=form::close();?>