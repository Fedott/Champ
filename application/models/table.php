<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    class Table_Model extends ORM
	{
		protected $has_many = array('lines');

		public function validate(array & $array, $save = FALSE)
		{
			$array = Validation::factory($array)
				->pre_filter('trim')
				->add_rules('name', 'required', 'length[2,30]')
				->add_callbacks('name', array($this, '_name_exists'));

			return parent::validate($array, $save);
		}

		public function _name_exists(Validation $array, $field)
		{
			$result = (bool) ORM::factory('table')->where(array('name' => $array[$field], 'id !=' => $this->id))->count_all();
			if($result)
			{
				$array->add_error($field, 'name_exists');
			}
		}
	}
