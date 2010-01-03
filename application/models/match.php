<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Match_Model extends ORM
	{
		protected $has_one = array('home' => 'line', 'away' => 'line', 'table');

		public function validate(array & $array, $save = FALSE)
		{
			$array = Validation::factory($array)
				->pre_filter('trim')
				->add_rules('home_id', 'required', 'numeric')
				->add_rules('away_id', 'required', 'numeric')
				->add_rules('home_goals', 'required', 'numeric')
				->add_rules('away_goals', 'required', 'numeric');

			return parent::validate($array, $save);
		}
	}
