<?php
/*
 *	[ ОБНОВЛЕНИЕ САМОЛЁТА ]
 */
include_once('../connect_bd.php');

if (!empty($_POST)) 
{
	try 
	{	
								/****************************
								 *	ПРОВЕРКА ВХОДНЫХ ДАННЫХ	*
								 ****************************/
		
		$id = $_POST['id'];

		$bort_num = strip_tags($_POST['bort_num']);
		$bort_num = htmlspecialchars($bort_num);
		$bort_num = $mysqli->real_escape_string($bort_num);
		
		$model = strip_tags($_POST['model']);
		$model = htmlspecialchars($model);
		$model = $mysqli->real_escape_string($model);
		
		$company = strip_tags($_POST['company']);
		$company = htmlspecialchars($company);
		$company = $mysqli->real_escape_string($company);
		
		$date_vipusk = strip_tags($_POST['date_vipusk']);
		$date_vipusk = htmlspecialchars($date_vipusk);
		$date_vipusk = $mysqli->real_escape_string($date_vipusk);
		
		$colvo_mest = strip_tags($_POST['colvo_mest']);
		$colvo_mest = htmlspecialchars($colvo_mest);
		$colvo_mest = $mysqli->real_escape_string($colvo_mest);

		/**
		 * Если поле количесво мест не целое положительное число 
		 * то по умолчанию сделать 100 мест в самолёте.
		 */
		if (!preg_match('/^\+?\d+$/', $colvo_mest))
			$colvo_mest = 100;

		

								/****************************
								 *	ПОДГОТОВКА ЗАПРОСА		*
								 ****************************/
		if (!($stmt = $mysqli->prepare("UPDATE samolet SET bort_num = ?, model = ?, company = ?, date_vipusk = ?, colvo_mest = ? WHERE id = ?")))
		{
			echo "invalid";
			exit();
		}

								/****************************
								 *	ПРИВЯЗКА ДАННЫХ			*
								 ****************************/

		if (!$stmt->bind_param('ssssii', $bort_num, $model, $company, $date_vipusk, $colvo_mest, $id))
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
