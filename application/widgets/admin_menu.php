<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Admin_Menu_Widget extends Widget
	{
		public function run()
		{
			$tpl = new View('admin_menu');

			return $tpl;
		}
	}
