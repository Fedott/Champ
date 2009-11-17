<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Menu_Widget extends Widget
	{
		public function run()
		{
			if(Auth::instance()->logged_in())
			{
				$tpl = "Привет, ".Auth::instance()->get_user()->username."!";
			}
			else
			{
				$tpl = "<a href='/user/login'>Войдите</a> на сайт";
			}

			return $tpl;
		}
	}
