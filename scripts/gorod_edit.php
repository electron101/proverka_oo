<?php
/*
 *	[ ОБНОВЛЕНИЕ ГОРОДА ]
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

		$gorod = strip_tags($_POST['gorod']);
		$gorod = htmlspecialchars($gorod);
		$gorod = $mysqli->real_escape_string($gorod);
		

								/****************************
								 *	ПОДГОТОВКА ЗАПРОСА		*
								 ****************************/

		if (!($stmt = $mysqli->prepare("UPDATE gorod SET name = ? WHERE id = ?")))
		{
			echo "invalid";
			exit();
		}

								/****************************
								 *	ПРИВЯЗКА ДАННЫХ			*
								 ****************************/

		if (!$stmt->bind_param('si', $gorod, $id))
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
