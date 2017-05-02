<?php 
include 'function/whoami.php';
if (IS_ADMIN)
{
	header('Location: ?act=main');
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
		padding-left: 0px;
	}
	
	.left_ {
		padding-left: 20px;
	}
	
	.interval {
		margin-bottom: -20px;
	}

	textarea {
    resize: none; /* Запрещаем изменять размер */
   } 
</style>

<div class="col-sm-6 col-sm-offset-3 ">
<!-- Контейнер, содержащий форму обратной связи -->
	<div class="box box-primary ">
		<!-- Заголовок контейнера -->
		<div class="box-header with-border">
			<h3 class="box-title">Информация о пассажире </h3>
		</div>
		<!-- Содержимое контейнера -->
		<div class="panel-body ">
						
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

<?php

if (!empty($_POST)) 
{
	$id_reis = $_POST["id_reis"];

	$result = $mysqli->query("SELECT reis.id_reis, reis.date_time_vilet, reis.date_time_posadka, 
									 g1.name as gorod_vilet, g2.name as gorod_posadka, 
									 samolet.bort_num, stoimost.sum FROM reis JOIN gorod as g1 
									 ON reis.id_gorod_vilet = g1.id JOIN gorod as g2 ON 
									 reis.id_gorod_posadka = g2.id JOIN samolet ON 
									 reis.id_samolet = samolet.id JOIN stoimost ON 
									 reis.id_reis = stoimost.id_reis WHERE reis.id_reis = '$id_reis'
id_gorod_vilet = 
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
			<form method = "POST" action = "?act=" role="form" id="Form">        

				<div class="form-group has-feedback">
				  <label for="inputText">Номер карты</label>
				  <input type="text" id="karta" name="karta" class="form-control" placeholder="Номер карты" required autofocus>
				  <span class="glyphicon form-control-feedback"></span>
				</div>
				
				<div class="form-group pull-right">
				  <button id="btn_passport" class="btn btn-info " type="submit">
					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Перейти к оплате картой</button>
				  <input type="hidden" name="id_reis" value=<?=$_POST['id_reis']?>>
				</div>

			</form>

		</div>
	</div>
</div>

<!-- <script> -->
<!-- $(function()  -->
<!-- { -->
<!--   //при отправке нажатии на кнопку отправления данных -->
<!--   $('#btn_passport').click(function(event)  -->
<!--   { -->
<!-- 	//отменить стандартное действие браузера -->
<!-- 	event.preventDefault(); -->
<!-- 	//завести переменную, которая будет говорить о том валидная форма или нет -->
<!-- 	var formValid = true; -->
<!-- 	//перебирает все элементы управления формы (input и textarea)  -->
<!-- 	$('#SearchTicketForm input,textarea').each(function()  -->
<!-- 	{ -->
<!-- 	  //найти предков, имеющих класс .form&#45;group (для установления success/error) -->
<!-- 	  var formGroup = $(this).parents('.form&#45;group'); -->
<!-- 	  //найти glyphicon (иконка успеха или ошибки) -->
<!-- 	  var glyphicon = formGroup.find('.form&#45;control&#45;feedback'); -->
<!-- 	  //валидация данных с помощью HTML5 функции checkValidity -->
<!-- 	  if (this.checkValidity())  -->
<!-- 	  { -->
<!-- 		//добавить к formGroup класс .has&#45;success и удалить .has&#45;error -->
<!-- 		formGroup.addClass('has&#45;success').removeClass('has&#45;error'); -->
<!-- 		//добавить к glyphicon класс .glyphicon&#45;ok и удалить .glyphicon&#45;remove -->
<!-- 		glyphicon.addClass('glyphicon&#45;ok').removeClass('glyphicon&#45;remove'); -->
<!-- 	  }  -->
<!-- 	  else  -->
<!-- 	  { -->
<!-- 		//добавить к formGroup класс .has&#45;error и удалить .has&#45;success -->
<!-- 		formGroup.addClass('has&#45;error').removeClass('has&#45;success'); -->
<!-- 		//добавить к glyphicon класс glyphicon&#45;remove и удалить glyphicon&#45;ok -->
<!-- 		glyphicon.addClass('glyphicon&#45;remove').removeClass('glyphicon&#45;ok'); -->
<!-- 		//если элемент не прошёл проверку, то отметить форму как не валидную  -->
<!-- 		formValid = false;   -->
<!-- 	  }	   -->
<!-- 	   -->
<!-- 	  var gorod_vilet   = $("#gorod_vilet").val(); -->
<!-- 	  var gorod_posadka = $("#gorod_posadka").val(); -->
<!--  -->
<!-- 		if (gorod_vilet == null)  -->
<!-- 		{		 -->
<!-- 			// получаем элемент, содержащий пароль -->
<!-- 			inputclient = $("#gorod_vilet"); -->
<!-- 			//найти предка, имеющего класс .form&#45;group (для установления success/error) -->
<!-- 			formGroupclient = inputclient.parents('.form&#45;group'); -->
<!-- 			//добавить к formGroup класс .has&#45;error и удалить .has&#45;success -->
<!-- 			formGroupclient.addClass('has&#45;error').removeClass('has&#45;success'); -->
<!-- 			 -->
<!-- 			formValid = false; -->
<!-- 		}   -->
<!-- 		 -->
<!-- 		if (gorod_posadka == null)  -->
<!-- 		{		 -->
<!-- 			// получаем элемент, содержащий пароль -->
<!-- 			inputclient = $("#gorod_posadka"); -->
<!-- 			//найти предка, имеющего класс .form&#45;group (для установления success/error) -->
<!-- 			formGroupclient = inputclient.parents('.form&#45;group'); -->
<!-- 			//добавить к formGroup класс .has&#45;error и удалить .has&#45;success -->
<!-- 			formGroupclient.addClass('has&#45;error').removeClass('has&#45;success'); -->
<!-- 			 -->
<!-- 			formValid = false; -->
<!-- 		}   -->
<!-- 	}); -->
<!--  -->
<!-- 	//если форма валидна, то -->
<!-- 	if (formValid)  -->
<!-- 	{	 -->
<!-- 		var str = $('#SearchTicketForm').serialize(); -->
<!--  -->
<!-- 		$.ajax( -->
<!-- 		{ -->
<!-- 			url: "scripts/ticket_show.php", -->
<!-- 			type: "POST", -->
<!-- 			dataType:"json", -->
<!-- 			data: str, -->
<!--  -->
<!-- 			success:function(msg) -->
<!-- 			{ -->
<!-- 				// echo JSON::encode($data); -->
<!-- 			}, -->
<!-- 			error:function(x,s,d) -->
<!-- 			{ -->
<!-- 				alert(d); -->
<!-- 			} -->
<!-- 		}); -->
<!-- 	} -->
<!--   }); -->
<!-- }); -->
<!-- </script> -->

<?php require 'templates/footer.php'; ?>
