<?php 
include 'function/whoami.php';
if (IS_ADMIN)
{
	header('Location: ?act=admin');
	exit(0);
}
require 'templates/header.php';
include_once('../connect_bd.php');
?>

<style>
	body {
	  padding-top: 75px;
	}    

	.left_krai {
		margin-left: 0px;
	}
	
	textarea {
    resize: none; /* Запрещаем изменять размер */
   } 
</style>

<div class="col-md-12 col-md-offset-0 left_krai">
<!-- Контейнер, содержащий форму обратной связи -->
	<div class="box box-primary">
		<!-- Заголовок контейнера -->
		<div class="box-header with-border">
			<h3 class="box-title">Укажите маршрут, чтобы найти авиабилеты </h3>
		</div>
		<!-- Содержимое контейнера -->
		<div class="box-body">
						
			<div class="alert alert-success hidden" id="success-alert">
				<strong>Успешно!</strong> Запись добавлена
			</div>
			<div class="alert alert-danger hidden" id="danger-alert">
				<strong>Неудача!</strong> Что то пошло не так
			</div>
			<div class="alert alert-danger hidden" id="client-not-select-alert">
				Клиент не выбран!
			</div>
			<div class="hidden" id="success-alert-btn">
				<a class="btn btn-sm btn-info" href="?act=ticket_add" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>
			</div>
			

		<div class="row">		
			<div class="col-md-2">
					<label for="inputText">От куда</label>
			</div>
			<div class="col-md-2">
					<label for="inputText">Куда</label>
			</div>
			<div class="col-md-3">
					<label for="inputText">Дата</label>
			</div>
			<div class="col-md-2">
					<label for="inputText">Класс</label>
			</div>
		</div>
			
			<form method = "POST" action = "" class="form-inline " role="form" id="SearchTicketForm">        
			<div class="row ">		

			<div class="col-md-2">
				<!-- #формирование ниспадающего списка -->
				<div class="form-group has-feedback">
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
							if ($row1['id'] == $_POST['gorod_vilet'])
								print "<OPTION value=".$row1['id']." selected>".$row1['name']."</OPTION>\n";
							else
								print "<OPTION value=".$row1['id'].">".$row1['name']."</OPTION>\n";
						}
					}
				?>
					</select>
				</div>
			</div>
				
			<div class="col-md-2">
				<!-- #формирование ниспадающего списка -->
				<div class="form-group has-feedback">
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
							if ($row1['id'] == $_POST['gorod_posadka'])
								print "<OPTION value=".$row1['id']." selected>".$row1['name']."</OPTION>\n";
							else
								print "<OPTION value=".$row1['id'].">".$row1['name']."</OPTION>\n";
						}
					}
				?>
					</select>
				</div>
			</div>
	
			<div class="col-md-3">
				<div class="form-group has-feedback">
					<!-- <label for="inputText">Дата</label> -->
				<!-- Элемент HTML с id равным datetimepicker1 -->
				  <div class=" input-group date input-append" id="datetimepicker_vilet">
					<span class="input-group-addon">
					  <i class="fa fa-calendar"></i>
					</span>
					<input type="text" id="date_vilet" name="date_vilet" value="<?=$_POST["date_vilet"]?>" class="form-control input-md" required>
					</input>
					<span class="glyphicon form-control-feedback"></span>
				  </div>
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
							minView: 2,
							// minuteStep: 15,
							// todayBtn : true,
							autoclose: true, 
							format: 'dd-mm-yyyy'
							// format: 'yyyy-mm-dd hh:ii:00'
							// format: 'yyyy-mm-dd'
						});
					});
				</script>

			<div class="col-md-3">
				<!-- #формирование ниспадающего списка -->
				<div class="form-group has-feedback">
					<select id="class" name = "class" class="form-control selectpicker show-tick" data-live-search="true" required>
						<option value="" disabled>Класс</option>
				<?php
					#подготовка запроса
					$result = $mysqli->query("SELECT id, name FROM class ");
					if ($result)
				  	{
						#заполнение списка содержимым
						while ($row1 = $result->fetch_array())
						{
							if ($row1['id'] == $_POST['class'])
								print "<OPTION value=".$row1['id']." selected>".$row1['name']."</OPTION>\n";
							else
								print "<OPTION value=".$row1['id'].">".$row1['name']."</OPTION>\n";
						}
					}
				?>
					</select>
				</div>
			</div>

				<div class="col-md-2 ">
					<div class="form-group pull-right">
					  <button id="btn_search" class="btn btn-info " type="submit">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Найти билеты</button>
				  <input type="hidden" name="id_reis" value=<?=$id?>>
					</div>
				</div>

				</div>
			</form>

<?php

if (!empty($_POST)) 
{
	$date_vilet       = $_POST["date_vilet"];
	$gorod_vilet      = $_POST["gorod_vilet"];
	$gorod_posadka    = $_POST["gorod_posadka"];
	$class            = $_POST["class"];
	
	$date_vilet_start = $date_vilet." 00:00:00";
	$date_vilet_end   = $date_vilet." 23:59:59";

	$result = $mysqli->query("SELECT reis.id_reis, reis.date_time_vilet, reis.date_time_posadka, 
									 g1.name as gorod_vilet, g2.name as gorod_posadka, 
									 samolet.bort_num, stoimost.sum, stoimost.id FROM reis JOIN gorod as g1 
									 ON reis.id_gorod_vilet = g1.id JOIN gorod as g2 ON 
									 reis.id_gorod_posadka = g2.id JOIN samolet ON 
									 reis.id_samolet = samolet.id JOIN stoimost ON 
									 reis.id_reis = stoimost.id_reis WHERE reis.id_gorod_vilet = 
									 '$gorod_vilet' AND reis.id_gorod_posadka = '$gorod_posadka' 
									 AND reis.colvo_mest > 0 AND reis.date_time_vilet BETWEEN 
									 STR_TO_DATE('$date_vilet_start', '%d-%m-%Y %H:%i:%s') AND 
									 STR_TO_DATE('$date_vilet_end', '%d-%m-%Y %H:%i:%s') AND
									 stoimost.id_class = '$class' ");
		
		if ($result):?>
			<br>
            <div class="table-responsive">
                <table class="table table-bordered table-hover " style=" font-size: 14px;" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Дата вылета</th>
                            <th>Дата посадки</th>
                            <th>Откуда</th>
                            <th>Куда</th>
                            <th>Бортовой номер</th>
                            <th>Стоимость</th>
                            <th class="text-right">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
						<form method="POST" action="?act=passajir" role="form" id="FormKupit">
	<?php while ($row = $result->fetch_assoc()):?>
	 					<tr>
                            <td style=" vertical-align: middle; "><small class=""><?=$row["id_reis"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["date_time_vilet"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["date_time_posadka"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["gorod_vilet"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["gorod_posadka"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["bort_num"]?></small>
                            </td>
                            <td style=" vertical-align: middle; "><small class=""><?=$row["sum"]?></small>
							</td>

                            <td class="text-right">
                                <div class="btn-group btn-group-xs ">

								<button id="btn_kupit" class="btn btn-info " type="submit">
									<i class="fa fa-shopping-cart"></i> Купить
								</button>
								  <input type="hidden" name="id_reis" value=<?=$row['id_reis']?>>
								  <input type="hidden" name="id_stoimost" value=<?=$row['id']?>>
								  <input type="hidden" name="date_vilet" value=<?=$row['date_time_vilet']?>>
								  <input type="hidden" name="date_posadka" value=<?=$row['date_time_posadka']?>>
								  <input type="hidden" name="gorod_vilet" value=<?=$row['gorod_vilet']?>>
								  <input type="hidden" name="gorod_posadka" value=<?=$row['gorod_posadka']?>>
								  <input type="hidden" name="bort_num" value=<?=$row['bort_num']?>>
								  <input type="hidden" name="sum" value=<?=$row['sum']?>>
								  <input type="hidden" name="class" value=<?=$class?>>
                                </div>
                            </td>
                            
                        </tr>
    <?php endwhile;?>
                        </form>
    				</tbody>
                </table>
            </div>

	<?php endif;

    $result->free();
	$mysqli->close();
}
?>

		</div>
	</div>
</div>

<!-- <script src="js/search_ticket.js"></script> -->

<script>
$(function() 
{
  //при отправке нажатии на кнопку отправления данных
  $('#btn_search').click(function(event) 
  {
	//отменить стандартное действие браузера
	event.preventDefault();
	//завести переменную, которая будет говорить о том валидная форма или нет
	var formValid = true;
	//перебирает все элементы управления формы (input и textarea) 
	$('#SearchTicketForm input,textarea').each(function() 
	{
	  //найти предков, имеющих класс .form-group (для установления success/error)
	  var formGroup = $(this).parents('.form-group');
	  //найти glyphicon (иконка успеха или ошибки)
	  var glyphicon = formGroup.find('.form-control-feedback');
	  //валидация данных с помощью HTML5 функции checkValidity
	  if (this.checkValidity()) 
	  {
		//добавить к formGroup класс .has-success и удалить .has-error
		formGroup.addClass('has-success').removeClass('has-error');
		//добавить к glyphicon класс .glyphicon-ok и удалить .glyphicon-remove
		glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
	  } 
	  else 
	  {
		//добавить к formGroup класс .has-error и удалить .has-success
		formGroup.addClass('has-error').removeClass('has-success');
		//добавить к glyphicon класс glyphicon-remove и удалить glyphicon-ok
		glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');
		//если элемент не прошёл проверку, то отметить форму как не валидную 
		formValid = false;  
	  }	  
	  
	  var gorod_vilet   = $("#gorod_vilet").val();
	  var gorod_posadka = $("#gorod_posadka").val();

		if (gorod_vilet == null) 
		{		
			// получаем элемент, содержащий пароль
			inputclient = $("#gorod_vilet");
			//найти предка, имеющего класс .form-group (для установления success/error)
			formGroupclient = inputclient.parents('.form-group');
			//добавить к formGroup класс .has-error и удалить .has-success
			formGroupclient.addClass('has-error').removeClass('has-success');
			
			formValid = false;
		}  
		
		if (gorod_posadka == null) 
		{		
			// получаем элемент, содержащий пароль
			inputclient = $("#gorod_posadka");
			//найти предка, имеющего класс .form-group (для установления success/error)
			formGroupclient = inputclient.parents('.form-group');
			//добавить к formGroup класс .has-error и удалить .has-success
			formGroupclient.addClass('has-error').removeClass('has-success');
			
			formValid = false;
		}  
	});

	//если форма валидна, то
	if (formValid) 
	{	
		var str = $('#SearchTicketForm').serialize();

		$.ajax(
		{
			url: "scripts/ticket_show.php",
			type: "POST",
			dataType:"json",
			data: str,

			success:function(msg)
			{
				// echo JSON::encode($data);
				// <?php echo $msg ?>
			},
			error:function(x,s,d)
			{
				alert(d);
			}
		});
	}
  });
});
</script>

<?php require 'templates/footer.php'; ?>
