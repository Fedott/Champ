<?php defined('SYSPATH') OR die('No direct access allowed.');

$lang = array(
	'home_id' => array(
		'default' => '',
		'required' => '',
		'numeric' => '',
	),
	'away_id' => array(
		'default' => 'Вы не указали команду соперника',
		'required' => 'Вы не указали команду соперника',
		'numeric' => 'Вы не указали команду соперника',
	),
	'home_goals' => array(
		'default' => '',
		'required' => 'Необходимо указать количество голов забытх хозяевами',
		'numeric' => 'Голы должны указываться цифрами',
	),
	'away_goals' => array(
		'default' => '',
		'required' => 'Необходимо указать количество голов забытх гостями',
		'numeric' => 'Голы должны указываться цифрами',
	),
	'goals' => array(
		'not_aval' => 'Не сходиться количество забитых голов и счёт мачта',
	)
);