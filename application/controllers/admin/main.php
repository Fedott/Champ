<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Main_Controller extends Admin_Controller
	{
		public function index()
		{
			$user = $this->user;
			$this->template->title = "Админка";
			$this->template->content = new View('admin/main');
			$this->template->content->user = $user;
		}
	}
