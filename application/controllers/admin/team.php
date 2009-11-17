<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Team_Controller extends Admin_Controller
	{
		public function index()
		{
			$this->template->title = "Команды";
			$this->template->content = new View('admin/team');
		}

		public function listen()
		{
			$teams = ORM::factory('team')->find_all();
			$this->template->title = "Список команд";
			$this->template->content = new View('admin/list_team');
			$this->template->content->teams = $teams;
			$this->template->content->i = 1;
		}

		public function edit($tid = NULL)
		{
			$team = ORM::factory('team', $tid);

			$form = array(
				'name'	=> '',
			);
			$errors = array();
			
			if($team->loaded)
			{
				$form = arr::overwrite($form, $team->as_array());
			}

			if($_POST)
			{
				$data = arr::overwrite($form, $_POST);
				
				$team->validate($data);
				$errors = $data->errors('edit_team');
				if(empty ($errors))
				{
					$team->url = translit::getTranslit($team->name);
					$team->save();
					url::redirect('/admin/team/view/'.$team->id);
				}
			}

			$this->template->title = "Редактирование команды";
			$this->template->content = new View('admin/edit_team');
			$this->template->content->form = $form;
			$this->template->content->errors = $errors;
		}

		public function view($url)
		{
			$team = ORM::factory('team', $url);

			$this->template->title = "Администрирование команды: ".$team->name;
			$this->template->content = new View('admin/view_team');
			$this->template->content->team = $team;
			$this->template->content->i = 1;
		}
		
	}
