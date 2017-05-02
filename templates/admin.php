<?php 
require 'templates/header_admin.php';
include 'function/whoami.php';
if (!IS_ADMIN)
	header('Location: ?act=main');
?>

<style>
	body 
	{
		padding-top: 50px;
	}    

	.left_krai {
		padding-left: -50px;
	}
	
	.interval {
		margin-bottom: -20px;
	}

	textarea {
    resize: none; /* Запрещаем изменять размер */
   } 
</style>

<div class="col-sm-12 col-sm-offset-0 ">
<!-- Контейнер, содержащий форму обратной связи -->
	<div class="box box-primary ">
		<!-- Заголовок контейнера -->
		<div class="box-header with-border">
			<h3 class="box-title">Панель администратора </h3>
		</div>
		<!-- Содержимое контейнера -->
		<div class="panel-body ">
			<p> Это панель администратора. Здесь вы можете добавлять, удалять и изменять информацию всех справочников и всех разделов базы данных. Для перехода к нужному разделу используейте меню слева. </p>

		</div>
	</div>
</div>

<?php require 'templates/footer.php'; ?>
