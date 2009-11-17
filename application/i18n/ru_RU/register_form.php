<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    $lang = array(
		'icq' => array(
			'default' => '',
			'required' => 'Заполните поле ICQ',
			'length' => '',
		),
		'first_name' => array(
			'default' => '',
			'length' => 'Слишком длинное Имя. Максимум 30 символов',
		),
		'last_name' => array(
			'default' => '',
			'length' => 'Слишком длинная Фамилия. Максимум 30 символов',
		),
		'www' => array(
			'default' => '',
			'url' => 'Неверный формат Сайта',
		),
		'like_club' => array(
			'default' => '',
			'length' => 'Любимый клуб максимум 50 символов',
		),
		'like_player' => array(
			'default' => '',
			'length' => 'Любимый игрок максимум 50 символов',
		),
			'email' => array(
			'default' => '',
			'required' => 'E-mail обязателен для заполнения',
			'length' => 'E-mail слишком длинный',
			'email' => 'E-mail не верный',
			'email_available' => 'Такой E-mail уже зарегистрирован',
		),
		'username' => array(
			'default' => '',
			'required' => 'Логин обязательное поле',
			'length' => 'Логин должен быть от 4 до 20 символов',
			'chars' => 'Недопустимые символы в Логине',
			'username_available' => 'Такой Логин уже зарегистрирован',
		),
		'password' => array(
			'default' => '',
			'required' => 'Вы не указали пароль',
			'length' => 'Длинна пароля должна быть от 6 до 20 символов',
		),
		'password_confirm' => array(
			'default' => '',
			'matches' => 'Пароль и подтвержение парлля не совпадают',
		),

	);