<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Admin_Controller extends Template_Controller
	{
		public function  __construct()
		{
			parent::__construct();
			if(!$this->auth->logged_in('admin'))
			{
				url::redirect('main');
			}
		}
	}
