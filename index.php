<?php 

/*--------------------------------------*/
/* ПРОВЕРКА ОБРАЗОВАТЕЛЬНЫХ ОРГАНИЗАЦИЙ */
/*--------------------------------------*/
session_start();

/* Отправка HTTP заголовка */ 
header('content-type text/html charset=utf-8');

/* Подключаем файл настроек базы данных */
include_once('connect_bd.php');

$act = isset($_GET['act']) ? $_GET['act'] : 'main';

switch ($act) 
{
	case 'login':
		require 'templates/login.php';
		break;
	
	case 'registry':
		require 'templates/registry.php';
		break;
	
	case 'main':
		require 'templates/main.php';
		break;
	
	case 'admin':
		require 'templates/admin.php';
		break;
	
	case 'gorod':
		require 'templates/gorod.php';
		break;
	
	case 'gorod_add':
		require 'templates/gorod_add.php';
		break;
	
	case 'gorod_edit':
		require 'templates/gorod_edit.php';
		break;
	
	case 'samolet':
		require 'templates/samolet.php';
		break;
	
	case 'samolet_add':
		require 'templates/samolet_add.php';
		break;

	case 'samolet_edit':
		require 'templates/samolet_edit.php';
		break;
	
	case 'reis':
		require 'templates/reis.php';
		break;
	
	case 'reis_add':
		require 'templates/reis_add.php';
		break;

	case 'reis_edit':
		require 'templates/reis_edit.php';
		break;
	
	case 'class':
		require 'templates/class.php';
		break;
	
	case 'class_add':
		require 'templates/class_add.php';
		break;

	case 'class_edit':
		require 'templates/class_edit.php';
		break;

	case 'stoimost':
		require 'templates/stoimost.php';
		break;
	
	case 'stoimost_add':
		require 'templates/stoimost_add.php';
		break;

	case 'stoimost_edit':
		require 'templates/stoimost_edit.php';
		break;

	case 'passajir':
		require 'templates/passajir.php';
		break;
	
	case 'oplata_karta':
		require 'templates/oplata_karta.php';
		break;

	case 'logout':		
		unset($_SESSION['id_user']);
		unset($_SESSION['login']);
		unset($_SESSION['priv']);
		session_destroy();
		header('Location: .');
		break;
	
	default:
		require 'templates/main.php';
		break;
}
?>
