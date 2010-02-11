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

		public static function get_human_date($date = NULL)
		{
			return date('d-m-Y H:i', $date);
		}

		public static function getTranslit($st)
		{
			$st = mb_strtolower($st, "UTF-8");
			$al = array('а','б','в','г','д','е','ё','ж','з','и','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я','й',' ');
			$bl = array('a','b','v','g','d','e','e','jg','z','i','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sh',"",'w',"",'ea','iu','iy','y','-');
			$st = str_replace($al, $bl, $st);

			return $st;
		}
	}