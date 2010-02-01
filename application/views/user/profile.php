<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h2><?=$user->username;?></h2>
<?=html::anchor('user/avatar', 'Изменить аватар');?>
<div class="avatar">
	<?=html::image($user->get_avatar());?>
</div>
<div class="user_info">
	
</div>