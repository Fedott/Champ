<?php defined('SYSPATH') OR die('No direct access allowed.');

	class misc {
		public static function get_goals_images($count)
		{
			$goals = '';
			for($i = 1; $i <= $count; $i++)
			{
				$goals.= "<img src=\"/templates/template/img/goal.gif\"/>\n";
			}

			return $goals;
		}
	}