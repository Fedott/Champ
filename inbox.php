<?php
$vk_login = 'tanmar';
$vk_pass = 'zaqxswcde';

$url = "http://vkontakte.ru/";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

$user_agent = "Mozilla/5.0 (iPhone; U; CPU iPhone OS 2_2_1 like Mac OS X; ru-ru) AppleWebKit/525.18.1 (KHTML, like Gecko) Version/3.1.1 Mobile/5H11 Safari/525.20";
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

$cookie_file = "cookie.cookie";
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);

curl_exec($ch);
curl_close($ch);

sleep(rand(3, 10));

$url = "http://login.vk.com/?act=login";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

$user_agent = "Mozilla/5.0 (iPhone; U; CPU iPhone OS 2_2_1 like Mac OS X; ru-ru) AppleWebKit/525.18.1 (KHTML, like Gecko) Version/3.1.1 Mobile/5H11 Safari/525.20";
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

$cookie_file = "cookie.cookie";
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);

curl_setopt($ch, CURLOPT_REFERER, "http://vkontakte.ru/");

$post = "email=".$vk_login."&pass=".$vk_pass;
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

$page = curl_exec($ch);

preg_match("/id='s' value='([a-zA-Z0-9]+)'>/", $page, $hashas);

curl_close($ch);

sleep(rand(3, 10));

$url = "http://vkontakte.ru/login.php?op=slogin&redirect=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

$user_agent = "Mozilla/5.0 (iPhone; U; CPU iPhone OS 2_2_1 like Mac OS X; ru-ru) AppleWebKit/525.18.1 (KHTML, like Gecko) Version/3.1.1 Mobile/5H11 Safari/525.20";
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

$cookie_file = "cookie.cookie";
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);

curl_setopt($ch, CURLOPT_REFERER, "http://login.vk.com/?act=login");

$post = "s=".$hashas[1];
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

$page = curl_exec($ch);

preg_match('/<a href="\/mail.php?id=([0-9]+)" tooltip="linkalert-tip">/', $page, $vk_id);
$vk_id = $vk_id[1];

curl_close($ch);

sleep(rand(3, 10));

$url = "http://vkontakte.ru/mail.php?id=".$vk_id;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

$user_agent = "Mozilla/5.0 (iPhone; U; CPU iPhone OS 2_2_1 like Mac OS X; ru-ru) AppleWebKit/525.18.1 (KHTML, like Gecko) Version/3.1.1 Mobile/5H11 Safari/525.20";
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

$cookie_file = "cookie.cookie";
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);

curl_setopt($ch, CURLOPT_REFERER, "http://vkontakte.ru/profile.php");

$page = curl_exec($ch);

header("Content-type: text/html; charset=utf-8");

if(preg_match_all('%<tr class=\'newRow\'.+<div class="name">.+<a href="/id[0-9]+">(.+)</a>.+</div>.+<div class="date">(.+)</div>.+class="new messageSubject"><span 0>(.+)</span></a>.+class="new messageBody">(.+)</div>.+</tr>%sU', $page, $messages, PREG_SET_ORDER))
{
	echo "Новые сообщения:<hr>";
	foreach ($messages as $message)
	{
		echo "От: ".iconv('cp1251', 'UTF-8', $message[1]);
		echo "<br>Дата: ".iconv('cp1251', 'UTF-8', $message[2]);
		echo "<br>Тема: ".iconv('cp1251', 'UTF-8', $message[3]);
		echo "<br>Сообщение: ".iconv('cp1251', 'UTF-8', $message[4]);
		echo "<hr>";
	}
}
else
{
	echo "Новых сообщений нет";
}

if(preg_match_all('%<tr.+<div class="name">.+<a href="/id[0-9]+">(.+)</a>.+</div>.+<div class="date">(.+)</div>.+class="new messageSubject"><span 0>(.+)</span></a>.+class="new messageBody">(.+)</div>.+</tr>%sU', $page, $messages, PREG_SET_ORDER))
{
	echo "Прочитанные сообщения:<hr>";
	foreach ($messages as $message)
	{
		echo "От: ".iconv('cp1251', 'UTF-8', $message[1]);
		echo "<br>Дата: ".iconv('cp1251', 'UTF-8', $message[2]);
		echo "<br>Тема: ".iconv('cp1251', 'UTF-8', $message[3]);
		echo "<br>Сообщение: ".iconv('cp1251', 'UTF-8', $message[4]);
		echo "<hr>";
	}
}
else
{
	echo "Прочитанных сообщений нет";
}

?>
