<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Match_Model extends ORM
	{
		protected $has_one = array('home' => 'line', 'away' => 'line');
	}
