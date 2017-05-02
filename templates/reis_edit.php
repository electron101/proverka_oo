<?php 
include 'function/whoami.php';
if (!IS_ADMIN)
	header('Location: ?act=main');
require 'templates/header_admin.php'; 

if (!isset($_GET["id_reis"]))
	header('Location: ?act=reis');
$id = $_GET["id_reis"];
?>
<style>
	body {
	  padding-top: 45px;
	}     

	.left_krai {
		padding-left: 0px;
	}
</style>

<div class="col-sm-5 col-sm-offset-0 left_krai">
<!-- Контейнер, содержащий форму обратной связи -->
	<div class="panel panel-info">
		<!-- Заголовок контейнера -->
		<div class="panel-heading panel-title">
			<h1 class="panel-title">Редактировать рейс</h1>
		</div>
		<!-- Содержимое контейнера -->
		<div class="panel-body">
						
			<div class="alert alert-success hidden" id="success-alert">
				<strong>Успешно!</strong> Запись обновлена
			</div>
			<div class="alert alert-danger hidden" id="danger-alert">
				<strong>Неудача!</strong> Что то пошло не так
			</div>
			<div class="hidden" id="success-alert-btn">
				<a class="btn btn-sm btn-info" href="?act=reis" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>
			</div>
			
	<?php
		$result = $mysqli->query("SELECT * FROM reis WHERE id_reis = '$id'");
		if ($result)   
			$row = $result->fetch_array()
	?>

			<form role="form" id="ReisEditForm">        

				<!-- #формирование ниспадающего списка -->
				<div class="form-group has-feedback">
					<label for="inputText">Город отправлеия</label>
					<select id="gorod_vilet" name = "gorod_vilet" class="form-control selectpicker show-tick" data-live-search="true" required>
						<option value="" disabled>Город отправлеия</option>
				<?php
					#подготовка запроса
					$result = $mysqli->query("SELECT id, name FROM gorod ");
					if ($result)
				  	{
						#заполнение списка содержимым
						while ($row1 = $result->fetch_array())
						{
							if ($row1['id'] == $row['id_gorod_vilet'])
								print "<OPTION value=".$row1['id']." selected>".$row1['name']."</OPTION>\n";
							else
								print "<OPTION value=".$row1['id'].">".$row1['name']."</OPTION>\n";
						}
					}
				?>
					</select>
				</div>


				<!-- #формирование ниспадающего списка -->
				<div class="form-group has-feedback">
					<label for="inputText">Город прибытия</label>
					<select id="gorod_posadka" name = "gorod_posadka" class="form-control selectpicker show-tick" data-live-search="true" required>
						<option value="" disabled>Город прибытия</option>
				<?php
					#подготовка запроса
					$result = $mysqli->query("SELECT id, name FROM gorod ");
					if ($result)
				  	{
						#заполнение списка содержимым
						while ($row1 = $result->fetch_array())
						{
							if ($row1['id'] == $row['id_gorod_posadka'])
								print "<OPTION value=".$row1['id']." selected>".$row1['name']."</OPTION>\n";
							else
								print "<OPTION value=".$row1['id'].">".$row1['name']."</OPTION>\n";
						}
					}
				?>
					</select>
				</div>


				<div class="form-group has-feedback">
				  <label for="inputText">Дата и время вылета</label>
				<!-- Элемент HTML с id равным datetimepicker1 -->
				  <div class=" input-group date input-append" id="datetimepicker_vilet">
					<span class="input-group-addon">
					  <i class="fa fa-calendar"></i>
					</span>
					<input type="text" id="date_vilet" name="date_vilet" value="<?=$row["date_time_vilet"]?>" class="form-control input-md" required>
					</input>
					<span class="glyphicon form-control-feedback"></span>
				  </div>
				  </div>
				<!-- Инициализация виджета "Bootstrap datetimepicker" -->
				<script type="text/javascript">
					$(function () 
					{
					// Идентификатор элемента HTML (например: #datetimepicker1), 
					// datetimepicker для которого необходимо инициализировать 
					// виджет "Bootstrap datetimepicker"
						$('#datetimepicker_vilet').datetimepicker({
							startDate: new Date(),
							minuteStep: 1,
							todayBtn : true,
							autoclose: true,
							// format: 'dd-mm-yyyy hh:ii:00'
							format: 'yyyy-mm-dd hh:ii:ss'
						});
					});
				</script>


				<div class="form-group has-feedback">
				  <label for="inputText">Дата и время посадки</label>
				<!-- Элемент HTML с id равным datetimepicker1 -->
				  <div class=" input-group date input-append" id="datetimepicker_posadka">
					<span class="input-group-addon">
					  <i class="fa fa-calendar"></i>
					</span>
					<input type="text" id="date_posadka" name="date_posadka" value="<?=$row["date_time_posadka"]?>" class="form-control input-md" required>
					</input>
					<span class="glyphicon form-control-feedback"></span>
				  </div>
				  </div>
				<!-- Инициализация виджета "Bootstrap datetimepicker" -->
				<script type="text/javascript">
					$(function () 
					{
					// Идентификатор элемента HTML (например: #datetimepicker1), 
					// datetimepicker для которого необходимо инициализировать 
					// виджет "Bootstrap datetimepicker"
						$('#datetimepicker_posadka').datetimepicker({
							startDate: new Date(),
							minuteStep: 1,
							todayBtn : true,
							autoclose: true,
							// format: 'dd-mm-yyyy hh:ii:00'
							format: 'yyyy-mm-dd hh:ii:ss'
						});
					});
				</script>

				<!-- #формирование ниспадающего списка -->
				<div class="form-group has-feedback">
					<label for="inputText">Бортовой номер самолёта</label>
					<select id="bort_num" name = "bort_num" class="form-control selectpicker show-tick" data-live-search="true" required>
						<option value="" disabled selected>Бортовой номер самолёта</option>
				<?php
					#подготовка запроса
					$result = $mysqli->query("SELECT id, bort_num FROM samolet ");
					if ($result)
				  	{
						#заполнение списка содержимым
						while ($row1 = $result->fetch_array())
						{
							if ($row1['id'] == $row['id_samolet'])
								print "<OPTION value=".$row1['id']." selected>".$row1['bort_num']."</OPTION>\n";
							else
								print "<OPTION value=".$row1['id'].">".$row1['bort_num']."</OPTION>\n";
						}
					}
				?>
					</select>
				</div>

				<div class="form-group">
				  <button id="btn_edit" class="btn btn-md btn-success" type="submit">
				  	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Обновить
				  </button>
				  <input type="hidden" name="id_reis" value=<?=$id?>>
				</div>

			</form>

		</div>
	</div>
</div>
  
<script src="js/reis_edit.js"></script>

<?php require 'templates/footer.php' ?>
