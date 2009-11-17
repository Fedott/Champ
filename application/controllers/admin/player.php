<?php defined('SYSPATH') OR die('No direct access allowed.');

	class Player_Controller extends Admin_Controller
	{
		public function index()
		{
			$this->template->title = "Управиление игроками";
			$this->template->content = new View('admin/player');
		}

		public function edit($id = NULL)
		{
			$player = ORM::factory('player', $id);

			$teams = ORM::factory('team')->find_all()->as_array();
			$tarr = array();
			foreach($teams as $team)
			{
				$tarr[$team->id] = $team->name;
			}

			$form = array(
				'first_name'	=> '',
				'last_name'		=> '',
				'team_id'		=> '',
			);
			$errors = array();

			if($player->loaded)
			{
				$form = arr::overwrite($form, $player->as_array());
			}

			if($_POST)
			{
				$player->validate($_POST);
				$form = arr::overwrite($form, $_POST->as_array());
				$errors = $_POST->errors('edit_player');

				if(!count($errors))
				{
					$player->save();
					url::redirect('admin/player');
				}
			}

			$this->template->title = "Редактирование игрока";
			$this->template->content = new View('admin/edit_player');
			$this->template->content->form = $form;
			$this->template->content->errors = $errors;
			$this->template->content->teams = $tarr;
		}

		public function adds($tid)
		{
			$plpost = array();
			$errors = array();
			$allow = array();
			$team = ORM::factory('team', $tid);

			if($_POST)
			{
//				echo kohana::debug($_POST);
				foreach($_POST['last_name'] as $key => $last_name)
				{
					if(!empty($last_name))
					{
						$plpost = array('last_name' => $last_name, 'first_name' => $_POST['first_name'][$key]);
						$player = ORM::factory('player');
						$player->validate($plpost);
						if(!count($plpost->errors()))
						{
							$player->team_id = $tid;
							$player->save();
							$allow[] = $player;
						}
						else
						{
							$errors[] = $_POST['first_name'][$key].' '.$last_name." - Уже существует";
						}

						unset ($player);
						$plpost = array();
					}
				}
			}

			$this->template->title = "Добавление игроков в команду: ".$team->name;
			$this->template->content = new View('admin/adds_players');
			$this->template->content->errors = $errors;
			$this->template->content->allow = $allow;
			$this->template->content->team = $team;
		}
	}
