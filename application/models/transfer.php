<?php defined('SYSPATH') OR die('No direct access allowed.');

	class Transfer_Model extends ORM {
		protected $belongs_to = array('old_team' => 'team', 'new_team' => 'team', 'player', 'moder' => 'user', 'buyer' => 'user', 'seller' => 'user');

		
	}