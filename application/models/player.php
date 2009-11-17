<?php defined('SYSPATH') OR die('No direct access allowed.');

	class Player_Model extends ORM
	{
		protected $belongs_to = array('team');

		public function validate(array & $array, $save = FALSE)
		{
			$array = Validation::factory($array)
				->pre_filter('trim')
				->add_rules('last_name', 'required', 'length[2,30]')
				->add_rules('first_name', 'length[2,30]')
				->add_rules('team_id', 'numeric')
				->add_callbacks('last_name', array($this, '_player_exists'));

			return parent::validate($array, $save);
		}

		public function _player_exists(Validation $array, $field)
		{
			$result = (bool) ORM::factory('player')->where(array('last_name' => $array[$field], 'first_name' => $array['first_name'], 'id !=' => $this->id))->count_all();
			if($result)
			{
				$array->add_error($field, 'player_exists');
			}
		}

		public function name($limit = TRUE)
		{
			if(!empty($this->first_name))
			{
				if($limit){
					$return = text::limit_chars($this->first_name, 1, '.');
				}
				else
				{
					$return = $this->last_name;
					$return.= ' '.$this->first_name;
				}
			}
			else
			{
				$return = $this->last_name;
			}

			return $return;
		}
	}
