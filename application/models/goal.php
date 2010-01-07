<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Goal_Model extends ORM
	{
		protected $belongs_to = array('player', 'match', 'table', 'line');
	}
