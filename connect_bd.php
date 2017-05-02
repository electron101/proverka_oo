<?php

/* Параметры для базы данных */
$mysqli = new mysqli("localhost", "root", "1991", "proverka_oo"); 

/* Кодировка по умолчанию */
if (!$mysqli->set_charset("utf8"))
	printf("Ошибка при загрузке набора символов utf8: %s\n", $mysqli->error);

/* Устанавливает/получает внутреннюю кодировку символов */
mb_internal_encoding('UTF-8');

/* Пробуем подключиться */
if (mysqli_connect_errno()) 
{ 
	printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
	exit(); 
}
?>
