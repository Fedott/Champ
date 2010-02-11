<?php defined('SYSPATH') OR die('No direct access allowed.');

	class News_Controller extends Admin_Controller {

		public function edit($id = NULL)
		{
			$news = ORM::factory('news', $id);

			$errors = array();
			$form = array(
				'title'	=> $news->title,
				'text'	=> $news->text,
			);

			if($_POST)
			{
				$news->validate($_POST);
				$errors = $_POST->errors('news_edit');

				if(empty($errors))
				{
					if(!$news->created)
						$news->created = time();

					$news->author	= $this->user->id;
					$news->url		= misc::getTranslit($news->title);

					$news->save();

					url::redirect('news/view/'.$news->url);
				}
				else
				{
					$form = $_POST->as_array();
				}
			}

			$view = new View('admin/news_edit');
			$view->form = $form;

			$this->template->title = "Создание/редактирование новости";
			$this->template->content = $view;
		}
	}