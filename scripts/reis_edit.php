<?php
/*
 *	[ ОБНОВЛЕНИЕ РЕЙСА ]
 */
include_once('../connect_bd.php');

if (!empty($_POST)) 
{
	try 
	{	
								/****************************
								 *	ПРОВЕРКА ВХОДНЫХ ДАННЫХ	*
								 ****************************/
		
		$id = $_POST['id_reis'];

		$gorod_vilet = strip_tags($_POST['gorod_vilet']);
		$gorod_vilet = htmlspecialchars($gorod_vilet);
		$gorod_vilet = $mysqli->real_escape_string($gorod_vilet);
		
		$gorod_posadka = strip_tags($_POST['gorod_posadka']);
		$gorod_posadka = htmlspecialchars($gorod_posadka);
		$gorod_posadka = $mysqli->real_escape_string($gorod_posadka);
		
		/** 
		 * поле в таблице id_samolet но переменная называется bort_num	
		 */
		$bort_num = strip_tags($_POST['bort_num']);
		$bort_num = htmlspecialchars($bort_num);
		$bort_num = $mysqli->real_escape_string($bort_num);

		/**
		 * Количество мест в рейсе. Берём из таблицы самолёт
		 */
		$result = $mysqli->query("SELECT colvo_mest FROM samolet WHERE id = '$bort_num'");
		if ($result) 
		{
			$row = $result->fetch_array();
			$colvo_mest = $row['colvo_mest'];
		}

		$date_vilet = $_POST['date_vilet2'];
	
		$date_posadka = $_POST['date_posadka2'];
		

								/****************************
								 *	ПОДГОТОВКА ЗАПРОСА		*
								 ****************************/
		if (!($stmt = $mysqli->prepare("UPDATE reis SET date_time_vilet = ?, 
														date_time_posadka = ?, 
														id_gorod_vilet = ?, 
														id_gorod_posadka = ?, 
														id_samolet = ?,
														colvo_mest = ? 
												WHERE	id_reis = ?")))
		{
			echo "invalid";
			exit();
		}

								/****************************
								 *	ПРИВЯЗКА ДАННЫХ			*
								 ****************************/

		if (!$stmt->bind_param('ssiiiii', $date_vilet, $date_posadka, $gorod_vilet, $gorod_posadka, $bort_num, $colvo_mest, $id))
		{
			echo "invalid";
			exit();
		}

								/****************************
								 *	ВЫПОЛНЕНИЕ ЗАПРОСА		*
								 ****************************/

		if (!$stmt->execute())
		{
			echo "invalid";
			exit();
		}

		/*******************************************************************************************/

		/* закрываем запрос */
		$stmt->close();
		/* закрываем открытое соединение */
		$mysqli->close(); 

		/* если всё успешно посылаем серверу success */
	    echo "success";

    } 
    catch (Exception $e) 
    {
		echo "invalid";
		exit();
	}
}
else 
{
	echo "invalid";
}
?>
