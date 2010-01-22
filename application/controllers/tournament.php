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
			$uchastie = (bool)count(ORM::factory('line')->where(array('user_id' => $this->user->id, 'table_id' => $tournament->id))->find_all());

			$this->template->title = "Турнир: ".$tournament->name;
			$this->template->content = new View('view_tournament');
			$this->template->content->tournament = $tournament;
			$this->template->content->i = 1;
			$this->template->content->uchastie = $uchastie;
		}

		public function team($line_id)
		{
			$line = ORM::factory('line', $line_id);

			$home_matches = ORM::factory('match')->where(array('home_id' => $line->id))->find_all();
			$away_matches = ORM::factory('match')->where(array('away_id' => $line->id))->find_all();

			$view = new View('line_view');
			$view->hm = $home_matches;
			$view->am = $away_matches;
			$view->line = $line;

			$this->template->title = "Команда ".$line->team->name.", в турнире ".$line->table->name;
			$this->template->content = $view;
		}
	}
