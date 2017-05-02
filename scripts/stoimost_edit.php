<?php
/*
 *	[ ОБНОВЛЕНИЕ СТОИМОСТИ ]
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

		$reis     = strip_tags($_POST['reis']);
		$reis     = htmlspecialchars($reis);
		$reis     = $mysqli->real_escape_string($reis);
		
		$class    = strip_tags($_POST['class']);
		$class    = htmlspecialchars($class);
		$class    = $mysqli->real_escape_string($class);
		
		$stoimost = strip_tags($_POST['stoimost']);
		$stoimost = htmlspecialchars($stoimost);
		$stoimost = $mysqli->real_escape_string($stoimost);

		/**
		 * Проверка для поля стоимости. Это должно быть целое число или 
		 * число с точкой! не с запятой. Инача по уполчанию 100 рублей
		 */
		if (!preg_match('/^(?:0|[1-9]\d{0,5})(?:\.\d{1,3})?$/', $stoimost))
			$stoimost = 100;
		

								/****************************
								 *	ПОДГОТОВКА ЗАПРОСА		*
								 ****************************/

		if (!($stmt = $mysqli->prepare("UPDATE stoimost SET id_reis = ?, id_class = ?, sum = ? WHERE id = ?")))
		{
			echo "invalid";
			exit();
		}

								/****************************
								 *	ПРИВЯЗКА ДАННЫХ			*
								 ****************************/

		if (!$stmt->bind_param('iidi', $reis, $class, $stoimost, $id))
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
