<?php defined('SYSPATH') OR die('No direct access allowed.');

class User_Model extends Auth_User_Model {
	protected $has_many = array('lines');
	
//	public function validate(array & $array, $save = FALSE)
//	{
//		$array = Validation::factory($array)
//			->add_rules('icq', 'required', 'length[5,12]')
//			->add_rules('last_name', 'length[0,30]')
//			->add_rules('first_name', 'length[0,30]')
//			->add_rules('www', 'url')
//			->add_rules('like_club', 'length[0,50]')
//			->add_rules('like_player', 'length[0,50]');
//
//		return parent::validate($array, $save);
//	}

	public function get_avatar()
	{
		if(!empty($this->avatar))
		{
			return $this->avatar;
		}
		else
		{
			return 'media/avatars/noava.jpg';
		}
	}
	
} // End User Model