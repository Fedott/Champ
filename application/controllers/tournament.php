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
			$lines = ORM::factory('line')->with('team')->where(array('table_id' => $tournament->id))->find_all();
			$my_line = ORM::factory('line')->with('team')->where(array('user_id' => $this->user->id, 'table_id' => $tournament->id))->find();
			$uchastie = (bool)$my_line->loaded;

			$db = new Database();
			$res = $db->from('goals')
				->select(array('goals.player_id', 'SUM(`count`) as goals', 'goals.line_id'))
				->groupby('player_id')
				->limit(10)
				->orderby('goals', 'DESC')
				->where('table_id', $tournament->id)
				->get();

			$goleodors = array();
			foreach ($res as $row)
			{
				$players_like[] = $row->player_id;
				$goleodors[$row->player_id] = array('player_id' => $row->player_id, 'goals' => $row->goals, 'line_id' => $row->line_id);
//				$goleodors[] = array('player' => ORM::factory('player')->with('team')->find($row->player_id), 'goals' => $row->goals, 'line_id' => $row->line_id);
			}

			$players_goals = ORM::factory('player')->with('team')->in('players.id', implode(',', $players_like))->find_all();

			foreach($players_goals as $player)
			{
				$goleodors[$player->id]['player'] = $player;
			}


			$view = new View('view_tournament');
			$view->tournament = $tournament;
			$view->i = 1;
			$view->uchastie = $uchastie;
			$view->goleodors = $goleodors;
			$view->my_line = $my_line;
			$view->lines = $lines;

			$this->template->title = "Турнир: ".$tournament->name;
			$this->template->content = $view;
		}

		public function team($line_id)
		{
			$line = ORM::factory('line', $line_id);

			$home_matches = ORM::factory('match')->with('home')->with('away')->where(array('home_id' => $line->id))->find_all();
			$away_matches = ORM::factory('match')->with('home')->with('away')->where(array('away_id' => $line->id))->find_all();
//			$matches = ORM::factory('match')->with('home')->with('away')->where('home_id', $line->id)->orwhere('away_id', $line->id)->find_all();

			$db = new Database();
			$res = $db->from('goals')
				->select(array('goals.player_id', 'SUM(`count`) as goals', 'goals.line_id'))
				->where('line_id', $line->id)
				->groupby('player_id')
				->orderby('goals', 'DESC')
				->get();

			$goleodors = array();
			foreach ($res as $row)
			{
				$players_like[] = $row->player_id;
				$goleodors[$row->player_id] = array('player_id' => $row->player_id, 'goals' => $row->goals, 'line_id' => $row->line_id);
//				$goleodors[] = array('player' => ORM::factory('player')->with('team')->find($row->player_id), 'goals' => $row->goals, 'line_id' => $row->line_id);
			}

			$players_goals = ORM::factory('player')->with('team')->in('players.id', implode(',', $players_like))->find_all();

			foreach($players_goals as $player)
			{
				$goleodors[$player->id]['player'] = $player;
			}

			// Для обеспечения в будущем количества кругов;
			$krugov = 2;
			$arr_play_or_not_play = array();

			$all_table_lines = ORM::factory('line')->with('team')->where(array('table_id' => $line->table_id))->find_all();
			foreach($all_table_lines as $ll)
				$arr_play_or_not_play[$ll->id] = 0;

			foreach ($home_matches as $match)
			{
				if($match->home_id == $line->id)
				{
					$arr_play_or_not_play[$match->away_id]+= 1;
				}
				if($match->away_id == $line->id)
				{
					$arr_play_or_not_play[$match->home_id]+= 1;
				}
			}

			foreach ($away_matches as $match)
			{
				if($match->home_id == $line->id)
				{
					$arr_play_or_not_play[$match->away_id]+= 1;
				}
				if($match->away_id == $line->id)
				{
					$arr_play_or_not_play[$match->home_id]+= 1;
				}
			}

			$view = new View('line_view');
			$view->hm = $home_matches;
			$view->am = $away_matches;
			$view->line = $line;
			$view->goleodors = $goleodors;
			$view->play_or_not_play = $arr_play_or_not_play;
			$view->krugov = $krugov;
			$view->all_table_lines = $all_table_lines;

			$this->template->title = "Команда ".$line->team->name.", в турнире ".$line->table->name;
			$this->template->content = $view;
		}
	}
