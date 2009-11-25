<?php defined('SYSPATH') OR die('No direct access allowed.');

	class Main_Controller extends Template_Controller
	{
		public function index()
		{
			$this->template->title = "Главная страинца";
			$this->template->content = new View('main');
		}
	}
