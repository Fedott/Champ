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
			$matches = ORM::factory('match')->with('home')->with('away')->where(array('confirm' => 1, 'home.user_id' => $this->user->id))->find_all();
			$matches_a = ORM::factory('match')->with('home')->with('away')->where(array('confirm' => 1, 'away.user_id' => $this->user->id))->find_all();
//			echo Kohana::debug($matches);
			$this->template->title = "Ваши матчи";
			$this->template->content = new View('match');
			$this->template->content->uncmatches = $uncmatches;
			$this->template->content->matches = $matches;
			$this->template->content->matches_a = $matches_a;
		}

		public function reg($tourn = 2)
		{
			$match = ORM::factory('match');

			$form = array(
				'away_id' => '',
				'home_id'	=> '',
				'home_goals'	=> '',
				'away_goals'	=> '',
			);

			$errors = array();

			if($_POST)
			{
				$post = arr::overwrite($form, $_POST);

				$match->validate($post);
				$errors = $post->errors();

				if(empty($errors))
				{
					$match->date = time();
					$match->save();
					url::redirect('match');
				}
				else
				{
					$form = $match->as_array();
				}
			}

			$teams = ORM::factory('line')->where(array('user_id != ' => $this->user->id , 'table_id' => $tourn))->find_all();
			$tarr = array();
			foreach($teams as $team)
			{
				$tarr[$team->id] = $team->team->name;
			}

			$uteam = ORM::factory('line')->where(array('user_id' => $this->user->id, 'table_id' => $tourn))->find();

			$this->template->title = "Регистрация матча";
			$this->template->content = new View('match_reg');
			$this->template->content->form = $form;
			$this->template->content->errors = $errors;
			$this->template->content->teams = $tarr;
			$this->template->content->uteam = $uteam;
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
	}
