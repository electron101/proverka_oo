<?php 

/*--------------------------------------*/
/* ПРОВЕРКА ОБРАЗОВАТЕЛЬНЫХ ОРГАНИЗАЦИЙ */
/*--------------------------------------*/
session_start();

/* Отправка HTTP заголовка */ 
header('content-type text/html charset=utf-8');

/* Подключаем файл настроек базы данных */
include_once('connect_bd.php');

$act = isset($_GET['act']) ? $_GET['act'] : 'login';

switch ($act) 
{
	case 'lk':
		require 'template/lk.php'; 
		break;

	case 'user':
		require 'template/user.php'; 
		break;
	
	case 'user_add':
		require 'template/user_add.php'; 
		break;

	case 'user_edit':
		require 'template/user_edit.php'; 
		break;

	case 'recover_login':
		require 'template/recover_login.php'; 
		break;

	case 'login':
		/* если уже зареган то на страницу 
		входа уже не преходим, только в 
		личный кабинет, если же не зареган
		то на страницу входа */
		if (isset($_SESSION['id_user']))
			require 'template/lk.php';
		else
			require 'template/login.php'; 
		break;

	case 'smena_pw':
		require 'template/smena_pw.php'; 
		break;			

	case 'logout':		
		unset($_SESSION['id_user']);
		unset($_SESSION['login']);
		unset($_SESSION['priv']);
		session_destroy();
		header('Location: .');
		break;
	
	default:
		//require 'template/login.php';
		break;
}
?>
