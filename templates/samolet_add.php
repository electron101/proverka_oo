<?php 
include 'function/whoami.php';
if (!IS_ADMIN)
	header('Location: ?act=main');
require 'templates/header_admin.php'; 
include('../connect_bd.php');
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
			<h1 class="panel-title">Новый самолёт</h1>
		</div>
		<!-- Содержимое контейнера -->
		<div class="panel-body">
						
			<div class="alert alert-success hidden" id="success-alert">
				<strong>Успешно!</strong> Запись добавлена
			</div>
			<div class="alert alert-danger hidden" id="danger-alert">
				<strong>Неудача!</strong> Что то пошло не так
			</div>
			<div class="hidden" id="success-alert-btn">
				<a class="btn btn-sm btn-info" href="?act=samolet_add" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>
			</div>
			
			<form role="form" id="SamoletAddForm">        

				<div class="form-group has-feedback">
				  <label for="inputText">Бортовой номер</label>
				  <input type="text" id="bort_num" name="bort_num" class="form-control" placeholder="Бортовой номер" required autofocus>
				  <span class="glyphicon form-control-feedback"></span>
				</div>
				
				<div class="form-group has-feedback">
				  <label for="inputText">Модель</label>
				  <input type="text" id="model" name="model" class="form-control" placeholder="Модель" required >
				  <span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
				  <label for="inputText">Компания</label>
				  <input type="text" id="company" name="company" class="form-control" placeholder="Компания" required >
				  <span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
				  <label for="inputText">Дата выпуска</label>
				  <input type="text" id="date_vipusk" name="date_vipusk" class="form-control" placeholder="Дата выпуска" required >
				  <span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
				  <label for="inputText">Количество мест</label>
				  <input type="text" id="colvo_mest" name="colvo_mest" class="form-control" placeholder="Количество мест" required >
				  <span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group">
				  <button id="btn_add" class="btn btn-md btn-success" type="submit">
				  	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Добавить</button>
				</div>

			</form>

		</div>
	</div>
</div>
  
<script src="js/samolet_add.js"></script>

<?php require 'templates/footer.php' ?>
