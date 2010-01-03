<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Line_Model extends ORM
	{
		protected $belongs_to = array('table', 'team', 'user');

		protected $sorting = array('points' => 'desc', 'win' => 'desc', 'games' => 'asc', 'goals' => 'desc', 'passed_goals' => 'asc');
	}
