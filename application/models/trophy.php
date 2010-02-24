<?php defined('SYSPATH') OR die('No direct access allowed.');

	class Trophy_Model extends ORM {
		protected $belongs_to = array('team', 'table', 'user', 'line');

		public function validate(array & $array, $save = FALSE)
		{
			$array = Validation::factory($array)
				->pre_filter('trim')
				->add_rules('description', 'required')
				->add_rules('weight', 'numeric')
				->add_rules('table_id', 'numeric');

			return parent::validate($array, $save);
		}

		public function reward($line)
		{
			if($this->loaded)
			{
				$this->line_id = $line->id;
				$this->user_id = $line->user_id;
				$this->team_id = $line->team_id;

				return $this->save();
			}

			return FALSE;
		}
	}