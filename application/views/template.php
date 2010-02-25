<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title><?=$title?> | Чемпионат Красивый футбол!</title>
	<?=html::stylesheet(array(
			'templates/template/css/reset',
			'templates/template/css/main',
			'templates/template/css/form',
			'templates/template/js/jwysiwyg/jquery.wysiwyg.css',
		));?>
	<?=html::script(array(
			'templates/template/js/jquery',
			'templates/template/js/jquery.listen',
			'templates/template/js/main',
		));?>
</head>
<body>
	<div id="center">
		<div id="head" onClick="window.location='/'" style="cursor:pointer">
			
		</div>
<!--		<div id="menu">
			<div id="menu_left"></div>
			<div id="menu_center">
				<a href="/" class="menu_button">Главная</a>
				<a href="/match/" class="menu_button">Матчи</a>
				<a href="/team/" class="menu_button">Команды</a>
				<a href="/tournaments/" class="menu_button">Турниры</a>
			</div>
			<div id="menu_right"></div> 
		</div>-->
		
		<div id="middle">
			<div id="container">
				<div id="content">
					<?if($this->session->get('apply_message')):?>
					<div class="apply_message">
						<?=$this->session->get('apply_message');?>
					</div>
					<?endif;?>
					<?=$content?>
				</div>
			</div>
			<div id="sidebar" class="sl">
				<?=Widget::factory('menu', FALSE)->render()?>
				<?if($this->auth->logged_in('admin')):?>
					<?=Widget::factory('admin_menu', FALSE)->render()?>
				<?endif;?>
			</div>
		</div>
		<div id="footer">
		
		</div>
	</div>
	
</body>
</html>