--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation'),
(2, 'admin', 'Administrative user, has access to everything.');


--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`, `icq`, `first_name`, `last_name`, `www`, `like_club`, `like_player`) VALUES
(1, 'admin@champ.ru', 'admin', 'c6045fe4bd14fa438a87cdf9e2fcb7c364ee89323b08382fc3', 7, 1262513089, '000000', '', '', '', '', '');

