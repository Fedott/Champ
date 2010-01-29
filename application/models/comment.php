<?php defined('SYSPATH') OR die('No direct access allowed.');

	class Comment_Model extends ORM {

		protected $belongs_to = array('match', 'author' => 'user');
	}