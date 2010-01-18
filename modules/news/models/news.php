<?php defined('SYSPATH') OR die('No direct access allowed.');

	class News_Model extends ORM
	{

		protected $sorting = array('created' => 'desc');

		public function unique_key($id)
		{
			if(!empty($id) && !ctype_digit($id) && is_string($id))
			{
				return 'url';
			}

			return parent::unique_key($id);
		}

		public function validate(array & $array, $save = FALSE)
		{
			$array = Validation::factory($array)
				->add_filter('trim')
				->add_rules('title', 'required', 'length[1,255]')
				->add_rules('text', 'required')
				->add_rules('url', 'required', array($this, '_url_exists'))
				;

			return parent::validate($array, $save);
		}

		public function _url_exists($url)
		{
			return (bool)!$this->db
				->where(array('url' => $url, 'id !=' => $this->id))
				->count_records($this->table_name);
		}
	}