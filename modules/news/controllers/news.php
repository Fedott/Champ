<?php defined('SYSPATH') OR die('No direct access allowed.');

	class News_Controller extends Template_Controller
	{
		protected $page_items = 10;

		public function index($page = 0)
		{
			if($page)
				$page--;
				
			$news = ORM::factory('news')->limit($this->page_items, $page*$this->page_items)->find_all();

			$this->pagination = new Pagination(array(
				'style'			 => 'digg',
				'base_url'		 => '/news/index/',
				'items_per_page' => $this->page_items,
				'total_items'	 => ORM::factory('news')->count_all(),
				'auto_hide'		 => TRUE,
			));

			$this->template->title = "Новости";
			$this->template->content = new View('news');
			$this->template->content->news = $news;
		}

		public function view($url)
		{
			$news = ORM::factory('news', $url);

			$this->template->title = $news->title;
			$this->template->content = new View('news_view');
			$this->template->content->news = $news;
		}
	}