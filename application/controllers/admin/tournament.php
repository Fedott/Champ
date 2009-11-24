<?php defined('SYSPATH') OR die('No direct access allowed.');

	class Tournament_Controller extends Admin_Controller
	{
		public function index()
		{
			$this->template->title = "Турниры";
			$this->template->content = new View('admin/tournament');
		}

		public function listen()
		{
			$tournamets = ORM::factory('table')->find_all();

			$this->template->title = "Список турниров";
			$this->template->content = new View('admin/list_tournaments');
			$this->template->content->tournaments = $tournamets;
			$this->template->content->i = 1;
		}
	}
