<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Match_Model extends ORM
	{
		protected $has_one = array('home' => 'line', 'away' => 'line', 'table');

		public function validate(array & $array, $save = FALSE)
		{
			$array = Validation::factory($array)
				->pre_filter('trim')
				->add_rules('home_id', 'required', 'numeric', array($this, '_allready_plays'))
				->add_rules('away_id', 'required', 'numeric')
				->add_rules('home_goals', 'required', 'numeric')
				->add_rules('away_goals', 'required', 'numeric');

			return parent::validate($array, $save);
		}

		public function _allready_plays($home_id)
		{
			return (bool) ! $this->db->where(array('home_id' => $this->home_id, 'away_id' => $this->away_id))->count_records($this->table_name);
		}
	}
