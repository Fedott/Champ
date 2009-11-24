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

		public function edit($tid = NULL)
		{
			$tournament = ORM::factory('table', $tid);

			$form = array(
				'name'	=> '',
			);
			$errors = array();

			if($tournament->loaded)
			{
				$form = arr::overwrite($form, $tournament->as_array());
			}

			if($_POST)
			{
				$data = arr::overwrite($form, $_POST);

				$tournament->validate($data);
				$errors = $data->errors('edit_tournament');
				if(empty ($errors))
				{
					$tournament->url = translit::getTranslit($tournament->name);
					$tournament->save();
					url::redirect('/admin/tournament/view/'.$tournament->id);
				}
			}

			$this->template->title = "Редактирование команды";
			$this->template->content = new View('admin/edit_tournament');
			$this->template->content->form = $form;
			$this->template->content->errors = $errors;
		}

		public function view($url)
		{
			$tournament = ORM::factory('table', $url);

			$this->template->title = "Администрирование турнира: ".$tournament->name;
			$this->template->content = new View('admin/view_tournament');
			$this->template->content->tournament = $tournament;
			$this->template->content->i = 1;
		}
	}
