<?php defined('SYSPATH') OR die('No direct access allowed.');

	class Tournament_Controller extends Template_Controller
	{
		public function index()
		{
			$tournaments = ORM::factory('table')->find_all();

			$this->template->title = "Турниры";
			$this->template->content = new View('tournament');
			$this->template->content->tournaments = $tournaments;
			$this->template->content->i = 1;
		}

		public function view($url)
		{
			$tournament = ORM::factory('table', $url);

			$this->template->title = "Турнир: ".$tournament->name;
			$this->template->content = new View('view_tournament');
			$this->template->content->tournament = $tournament;
			$this->template->content->i = 1;
		}
	}
