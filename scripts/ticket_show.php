<?php
/*
 *	[ ВЫТАЩИТЬ ИНФУ О РЕЙСАХ ]
 */
include_once('../connect_bd.php');

if (!empty($_POST)) 
{
	try 
	{
		$date_vilet    = $_POST["date_vilet"];
		$gorod_vilet   = $_POST["gorod_vilet"];
		$gorod_posadka = $_POST["gorod_posadka"];
		
		
		$date_vilet_start = $date_vilet." 00:00:00";
		$date_vilet_end   = $date_vilet." 23:59:59";

		if (!$result = ($mysqli->query("SELECT * FROM reis WHERE id_gorod_vilet = '$gorod_vilet' AND id_gorod_posadka = '$gorod_posadka' AND colvo_mest > 0 AND date_time_vilet BETWEEN STR_TO_DATE('$date_vilet_start', '%d-%m-%Y %H:%i:%s') AND STR_TO_DATE('$date_vilet_end', '%d-%m-%Y %H:%i:%s')")))
		{
			echo "invalid";
			$mysqli->close();
			exit();
		}

		$row = $result->fetch_array();

	
		/* закрываем открытое соединение */
		$mysqli->close(); 
		
		/* json_encode - Возвращает JSON-представление данных 

				ПРИМЕР
		<?php
			$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

			echo json_encode($arr);
		?>

		Результат выполнения данного примера:

		{"a":1,"b":2,"c":3,"d":4,"e":5}

		*/
	
		echo json_encode ( $row );
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
