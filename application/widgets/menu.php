<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Menu_Widget extends Widget
	{
		public function run()
		{
			$user = NULL;
			$teams = NULL;
			if(Auth::instance()->logged_in())
			{
				$user = Auth::instance()->get_user();
				$teams = ORM::factory('line')->with('table')->with('team')->where(array('user_id' => $user->id))->find_all();
			}

			$tpl = new View('menu');
			$tpl->user = $user;
			$tpl->teams = $teams;

			return $tpl;
		}
	}
