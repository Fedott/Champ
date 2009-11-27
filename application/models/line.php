<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Line_Model extends ORM
	{
		protected $belongs_to = array('table', 'team', 'user');

		protected $sorting = array('win' => 'desc', 'games' => 'asc', 'win_points' => 'desc', 'lose_points' => 'asc');
	}
