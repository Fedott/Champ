<?php defined('SYSPATH') OR die('No direct access allowed.');

	class Match_Controller extends Template_Controller
	{

		public function __construct()
		{
			parent::__construct();

			if(!$this->auth->logged_in())
			{
				url::redirect('login');
			}
		}

		public function index()
		{
			$uncmatches = ORM::factory('match')->with('home')->with('away')->where(array('confirm' => 0, 'away.user_id' => $this->user->id))->find_all();
			$uncymatches = ORM::factory('match')->with('home')->with('away')->where(array('confirm' => 0, 'home.user_id' => $this->user->id))->find_all();
			$matches = ORM::factory('match')->with('home')->with('away')->where(array('confirm' => 1, 'home.user_id' => $this->user->id))->find_all();
			$matches_a = ORM::factory('match')->with('home')->with('away')->where(array('confirm' => 1, 'away.user_id' => $this->user->id))->find_all();
//			echo Kohana::debug($matches);
			$this->template->title = "Ваши матчи";
			$this->template->content = new View('match');
			$this->template->content->uncmatches = $uncmatches;
			$this->template->content->uncymatches = $uncymatches;
			$this->template->content->matches = $matches;
			$this->template->content->matches_a = $matches_a;
		}

		public function reg($tourn)
		{
			$match = ORM::factory('match');
			$myline = ORM::factory('line')->where(array('user_id' => $this->user->id , 'table_id' => $tourn))->find();
			if(!$myline->loaded)
			{
				url::redirect('match/err');
			}

			$form = array(
				'away_id' => '',
				'home_id'	=> '',
				'home_goals'	=> '',
				'away_goals'	=> '',
			);
			$comment_text = '';

			$errors = array();

			if($_POST)
			{
				$errors_lang_file = 'match_reg';
				$post = arr::overwrite($form, $_POST);

				$match->validate($post);
				$errors = $post->errors($errors_lang_file);

				$val_goals_h = 0;
				foreach($_POST['goals_h'] as $gg)
				{
					if(!empty($gg[1]))
						$val_goals_h += $gg[1];
				}
				$val_goals_a = 0;
				if(isset($_POST['goals_a']))
				{
					foreach ($_POST['goals_a'] as $gg)
					{
						if(!empty($gg[1]))
							$val_goals_a += $gg[1];
					}
				}
				if($match->home_goals != $val_goals_h || $match->away_goals != $val_goals_a)
				{
					$errors[] = Kohana::lang("$errors_lang_file.goals.not_aval");
				}

				if(empty($errors))
				{
					$match->date = time();
					$match->table_id = $tourn;
					$match->save();

					$comment = ORM::factory('comment');
					$comment->text = text::auto_link(text::auto_p($_POST['comment']));
					$comment->match_id = $match->id;
					$comment->author_id = $this->user->id;
					$comment->date = date();
					$comment->save();
					
					foreach ($_POST['goals_h'] as $gg)
					{
						if(!empty ($gg[1]))
						{
							$tmp = ORM::factory('goal');
							$tmp->table_id	= $tourn;
							$tmp->player_id	= $gg[0];
							$tmp->count		= $gg[1];
							$tmp->match_id	= $match->id;
							$tmp->line_id	= $match->home_id;
							$tmp->save();
							$tmp = NULL;
						}
					}
					foreach ($_POST['goals_a'] as $gg)
					{
						if(!empty ($gg[1]))
						{
							$tmp = ORM::factory('goal');
							$tmp->table_id	= $tourn;
							$tmp->player_id	= $gg[0];
							$tmp->count		= $gg[1];
							$tmp->match_id	= $match->id;
							$tmp->line_id	= $match->away_id;
							$tmp->save();
							$tmp = NULL;
						}
					}
					url::redirect('match');
				}
				else
				{
					$form = $match->as_array();
					$comment_text = $_POST['comment'];
				}
			}

			$teams = ORM::factory('line')->where(array('user_id != ' => $this->user->id, 'table_id' => $tourn))->find_all();
			$my_matches = ORM::factory('match')->where(array('home_id' => $myline->id, 'table_id' => $tourn))->find_all();

			$tarr = array('NULL' => 'Выберите команду соперника');
			foreach($teams as $team)
			{
				$tarr[$team->id] = $team->team->name." (".$team->user->username.")";
			}

			foreach ($my_matches as $my_match)
			{
				arr::remove($my_match->away_id, $tarr);
			}

			$players = ORM::factory('player')->where(array('team_id' => $myline->team_id))->find_all();
			$plarr = array('NULL' => 'Выбирете игрока');
			foreach ($players as $player)
			{
				$plarr[$player->id] = $player->name();
			}

			$uteam = ORM::factory('line')->where(array('user_id' => $this->user->id, 'table_id' => $tourn))->find();

			$this->template->title = "Регистрация матча";
			$this->template->content = new View('match_reg');
			$this->template->content->form = $form;
			$this->template->content->errors = $errors;
			$this->template->content->teams = $tarr;
			$this->template->content->uteam = $uteam;
			$this->template->content->my_team_players = $plarr;
			$this->template->content->comment_text = $comment_text;
		}

		public function confirm($mid)
		{
			$match = ORM::factory('match', $mid);
			if($match->loaded AND $match->away->user_id == $this->user->id AND $match->confirm == 0)
			{
				$title = "Подтверждение матча";
				$content = new View('match_confirm');
				$content->match = $match;

				$this->template->title = $title;
				$this->template->content = $content;
			}
			else
			{
				url::redirect('match');
			}
		}

		public function confirm_ok($mid)
		{
			$match = ORM::factory('match', $mid);
			if($match->loaded AND $match->away->user_id == $this->user->id AND $match->confirm == 0)
			{
				$home = ORM::factory('line', $match->home_id);
				$away = ORM::factory('line', $match->away_id);
				$home->goals += $match->home_goals;
				$away->goals += $match->away_goals;
				$home->passed_goals += $match->away_goals;
				$away->passed_goals += $match->home_goals;
				if($match->home_goals == $match->away_goals)
				{
					$home->points += 1;
					$away->points += 1;
					$home->drawn++;
					$away->drawn++;
				}
				elseif ($match->home_goals > $match->away_goals)
				{
					$home->points += 3;
					$home->win++;
					$away->lose++;
				}
				elseif ($match->home_goals < $match->away_goals)
				{
					$away->points += 3;
					$home->lose++;
					$away->win++;
				}
				$home->games++;
				$away->games++;
				$home->save();
				$away->save();
				$match->confirm = 1;
				$match->save();
				url::redirect('match');
			}
			else
			{
				$this->template->title = "Не мухлюй!";
				$this->template->content = "<h1 style='color: red'>Не мухлюй!</h1>";
			}
		}

		public function get_away_team_players($tid)
		{
			if(!request::is_ajax() || $tid == 'NULL')
				exit;

			$this->auto_render = FALSE;

			$players = ORM::factory('player')->where(array('team_id' => ORM::factory('line', $tid)->team_id))->find_all();
			$plarr = array('NULL' => 'Выбирете игрока');
			foreach ($players as $player)
			{
				$plarr[$player->id] = $player->name();
			}

			$view = new View('ajax/away_team_players_goal');
			$view->team_players = $plarr;
			$view->render(TRUE);
		}

		public function test()
		{
			echo Kohana::debug($_POST);
			$this->template->title = 2;
			$this->template->content = '';
		}

		public function view($id)
		{
			$match = ORM::factory('match', $id);
			$home_goals = ORM::factory('goal')->with('player')->where(array('goals.match_id' => $id, 'goals.line_id' => $match->home_id))->find_all();
			$away_goals = ORM::factory('goal')->with('player')->where(array('goals.match_id' => $id, 'goals.line_id' => $match->away_id))->find_all();
			$comments = ORM::factory('comment')->where(array('match_id' => $match->id))->with('author')->find_all();

			$view = new View('match_view');
			$view->match = $match;
			$view->home_goals = $home_goals;
			$view->away_goals = $away_goals;
			$view->comments = $comments;

			$this->template->title = "Просмотр матча ".$match->home->team->name." - ".$match->away->team->name;
			$this->template->content = $view;
		}

		public function listen($tournid = NULL)
		{
			$tournament = ORM::factory('table', $tournid);

			if($tournid)
				$all = ORM::factory('match')
					->where(array('table_id' => $tournament->id))
					->count_all();
			else
				$all = ORM::factory('match')
					->count_all();

			$this->pagination = new Pagination(array(
				'total_items'	=> $all, // Total number of items.
				'query_string'	=> 'page',
			));

			if($tournid)
				$matches = ORM::factory('match')
					->where(array('matches.table_id' => $tournament->id))
					->orderby(array('date' => 'DESC'))
					->limit($this->pagination->items_per_page, $this->pagination->sql_offset)
					->with('table')
					->with('home')
					->with('away')
					->find_all();
			else
				$matches = ORM::factory('match')
					->orderby(array('matches.date' => 'DESC'))
					->limit($this->pagination->items_per_page, $this->pagination->sql_offset)
					->with('table')
					->with('home')
					->with('away')
					->find_all();

			$view = new View('matches_listen');
			$view->matches = $matches;
			$view->tourn = $tournament;

			$this->template->title = "Прошедшие матчи";
			$this->template->content = $view;
		}
	}
