<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class User_Controller extends Template_Controller
	{
		public function register()
		{
			$form = array(
				'username'	=> '',
				'email'		=> '',
				'icq'		=> '',
				'first_name'	=> '',
				'last_name'	=> '',
				'like_club'	=> '',
				'like_player'	=> '',
				'www'		=> '',
			);

			$errors = array();

			if($_POST)
			{
				$user = ORM::factory('user');

				$user->validate($_POST, FALSE);
				$errors = $_POST->errors();

				if(count($errors) == 0)
				{
					$user->add(ORM::factory('role', 'login'));
					if($user->save())
					{
						Auth::instance()->login($user, $_POST->password);
						url::redirect('/user/register_ok');
					}
				}
				else
				{
					$form = $_POST->as_array();
					$errors = $_POST->errors('register_form');
				}
			}

			$this->template->title = "Регистрация";
			$this->template->content = new View('user/regform');
			$this->template->content->form = $form;
			$this->template->content->errors = $errors;
		}

		public function register_ok()
		{
			$this->template->title = "Регистрация прошла успешно";
			$this->template->content = "<h2>Регистрация прошла успешно</h2><br>".html::anchor('main', "Главная страница");
		}

		public function login()
		{
			if(Auth::instance()->logged_in())
			{
				url::redirect('/');
			}
			else
			{
				$user = ORM::factory('user');
				$errors = array();

				if($_POST)
				{
					if(Auth::instance()->login($this->input->post('username'), $this->input->post('password'), (boolean)$this->input->post('remember')))
					{
						url::redirect("/");
					}
					else
					{
						$errors[] = "Неверный логин или пароль";
					}
				}

				$this->template->title = "Авторизация";
				$this->template->content = new View('user/login');
				$this->template->content->errors = $errors;
			}
		}

		public function logout()
		{
			Auth::instance()->logout();
			url::redirect('/user/login');
		}

		public function profile()
		{
			$auth = Auth::instance();
			if(!$auth->logged_in())
				exit;

			$user = $auth->get_user();

			$view = new View('user/profile');
			$view->user = $user;

			$this->template->title = "Ваш профиль";
			$this->template->content = $view;
		}

		public function avatar()
		{
			$auth = Auth::instance();
			if(!$auth->logged_in())
				exit;

			$user = $auth->get_user();

			if($_FILES)
			{
				$files = Validation::factory($_FILES)
					->add_rules('picture', 'upload::valid', 'upload::required', 'upload::type[gif,jpg,png]', 'upload::size[1M]');

				if ($files->validate())
				{
					// Temporary file name
					$filename = upload::save('picture');

					$img_url = 'media/avatars/'.text::random('alnum', 15).strrchr($filename, '.');

					// Resize, sharpen, and save the image
					Image::factory($filename)
						->resize(100, 100, Image::AUTO)
						->save(DOCROOT.$img_url);

					// Remove the temporary file
					unlink($filename);

					$user->avatar = $img_url;
					$user->save();
				}
			}

			$view = new View('user/edit_avatar');
			$view->user = $user;

			$this->template->title = "Редактирование аватара ";
			$this->template->content = $view;
		}

		public function view($id)
		{
			$user = ORM::factory('user', $id);

			$lines = ORM::factory('line')->with('team')->with('table')->where('lines.user_id', $user->id)->find_all();

			$view = new View('user/user_view');
			$view->user = $user;
			$view->lines = $lines;

			$this->template->title = "Пользователь, ".$user->username;
			$this->template->content = $view;
		}
	}
