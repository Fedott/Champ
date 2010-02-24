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

		public function adds($tid)
		{
// TODO: Сделать нормально добавление/удаление команд. При добавлении не выводить уже добавленные команды, а то некрасиво.
			$tournament = ORM::factory('table', $tid);
//			$teams = ORM::factory('team')->find_all();

			if($_POST)
			{
				foreach ($_POST['teams'] as $teamid)
				{
					$line = ORM::factory('line')->where(array('team_id' => $teamid, 'table_id' => $tournament->id))->find();
					if(!$line->loaded)
					{
						$line = ORM::factory('line');
						$line->team_id = $teamid;
						$line->table_id = $tournament->id;
						$line->save();
					}
				}
				$tournament->save();
				url::redirect('admin/tournament/view/'.$tournament->id);
			}

			$notlike_teams = array();
			$added_teams = ORM::factory('line')->where(array('table_id' => $tournament->id))->find_all();
			if(!empty ($added_teams))
			{
				foreach ($added_teams as $at)
				{
					$notlike_teams[] = $at->team_id;
				}
			}

			if(!empty ($notlike_teams))
				$teams = ORM::factory('team')->notin('id', $notlike_teams)->orderby('name')->find_all();
			else
				$teams = ORM::factory('team')->orderby('name')->find_all();

//			echo Kohana::debug($teams);

			$this->template->title = "Редактирование команд участников турнира: ". $tournament->name;
			$this->template->content = new View('admin/adds_tournament');
			$this->template->content->teams = $teams;
			$this->template->content->tournament = $tournament;
		}

		public function test()
		{
			$line = ORM::factory('line')->where(array('team_id' => 2, 'table_id' => 2))->find();
			echo Kohana::debug($line);
		}

		public function edit_trophy($id = NULL)
		{
			$trophy = ORM::factory('trophy', $id);

			$form = array(
				'description'	=> $trophy->description,
				'table_id'		=> $trophy->table_id,
				'weight'		=> $trophy->weight,
			);
			$errors = array();

			if($_POST)
			{
				$data = arr::overwrite($form, $_POST);

				$trophy->validate($data);
				$errors = $data->errors('edit_trophy');

				if($_FILES)
				{
					$files = Validation::factory($_FILES)
						->add_rules('picture', 'upload::valid', 'upload::required', 'upload::type[gif,jpg,png]', 'upload::size[1M]');

					if ($files->validate())
					{
						// Temporary file name
						$filename = upload::save('picture');

						$img_url = 'media/trophies/'.text::random('alnum', 15).strrchr($filename, '.');

						// Resize, sharpen, and save the image
						Image::factory($filename)
							->resize(300, 300, Image::AUTO) // TODO: Нужно подумать на счёт размера картинки трофея. Возможно стоит добавить миниатюру его и основное большое изображение
							->save(DOCROOT.$img_url);

						// Remove the temporary file
						unlink($filename);

						$trophy->image = $img_url;
						$trophy->save();
					}
				}

				if(empty ($errors))
				{
					$trophy->save();
					url::redirect('admin/tournament/view/'.$trophy->table_id);
				}
				else
				{
					$form = $data->as_array();
				}
			}

			$tables = ORM::factory('table')->find_all();
			$tarr = array();
			foreach($tables as $table)
			{
				$tarr[$table->id] = $table->name;
			}

			$view = new View('admin/trophy_edit');
			$view->trophy	= $trophy;
			$view->tables	= $tarr;
			$view->form		= $form;
			$view->errors	= $errors;

			$this->template->title = "Редактирование трофея";
			$this->template->content = $view;
		}

		public function line_view($lid)
		{
			$line = ORM::factory('line', $lid);

			$view = new View('admin/line_view');
			$view->line = $line;

			$this->template->title = "Команда, ".$line->team->name.", в турнире ".$line->table->name;
			$this->template->content = $view;
		}

		public function line_coach($lid)
		{
			$line = ORM::factory('line', $lid);

			if($_POST)
			{
				$user_id = $_POST['user_id'];

				$line->user_id = $user_id;
				$line->save();
				url::redirect('admin/tournament/view/'.$line->table_id);
			}

			$lines_user = ORM::factory('line')->where(array('table_id' => $line->table_id))->find_all();
			$notin = array('0');
			foreach ($lines_user as $user)
			{
				$notin[] = $user->user_id;
			}

			$users = ORM::factory('user')->notin('id', $notin)->find_all();
			$users_arr = array('0' => 'Выберите пользователя');
			foreach ($users as $user)
			{
				$users_arr[$user->id] = $user->username;
			}

			$view = new View('admin/line_coach');
			$view->line = $line;
			$view->users = $users_arr;

			$this->template->title = 'Назначить тренера команде '.$line->team->name.', в турнире '.$line->table->name;
			$this->template->content = $view;
		}

		public function line_trophy($lid)
		{
			$line = ORM::factory('line', $lid);

			if($_POST && $_POST['trophy_id'] != NULL)
			{
				$trophy = ORM::factory('trophy', $_POST['trophy_id']);
				$trophy->reward($line);
				url::redirect('tournament/team/'.$line->id);
			}

			$trophies = ORM::factory('trophy')->where(array('user_id' => 0, 'table_id' => $line->table_id))->find_all();
			$tr_arr = array('NULL' => 'Выберите трофей');
			foreach ($trophies as $tt)
			{
				$tr_arr[$tt->id] = $tt->description;
			}

			$view = new View('admin/line_trophy');
			$view->line = $line;
			$view->trophies = $tr_arr;

			$this->template->title = "Назначение трофея команде ".$line->team->name.', в турнире '.$line->table->name;
			$this->template->content = $view;
		}
	}
