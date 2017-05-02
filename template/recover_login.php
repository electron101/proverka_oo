<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- The above 3 meta tags *must* come first in the head; any other 
	head content must come *after* these tags -->

	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">

	<title>Информационно аналитическая система СНПДОО</title>

			
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="css/signin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/AdminLTE.css">
    <link rel="stylesheet" href="css/skin-blue.css">

	<style>
	body {
		padding-top: 90px;
	}    

	.skleit {
		margin-top: -16px;
	}

	.skleit_alert {
		margin-bottom: 5px;
		height: 10px;
	}

	p {
		margin-top: -10px;
	}

	h5 {
		padding-bottom: 50px;
	}

	.text-center {
		text-align: center;
	}

	.sk2 {
		margin-bottom: 15px;
	}

	.glyph {
		margin-top: 5px;
	}

	</style>

	<script src="jquery/jquery-3.1.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>

  </head>

  <body>
	<div class="container">

		<form class="form-signin" role="form" id="LoginRecoverForm">
		<h2 class="text-center form-signin-heading">Личный кабинет</h2>
		<h5 class="text-center form-signin-heading">
			Информационно аналитическая система СНПДОО
		</h5>

			<div class="alert alert-danger skleit_alert hidden" id="login-alert">
				<p>Неверный логин</p>
			</div>
			<div class="alert alert-danger skleit_alert hidden" id="danger-alert">
				<p>Что то пошло не так</p>
			</div>
			<div class="alert alert-success skleit_alert2 hidden" id="success-alert">
				<p>Инструкция по восстановлению пароля отправлена вам на почту!</p>
			</div>

			<div class="form-group sk2 has-feedback">
				<input type="text" name="login" class="form-control" placeholder="Логин" required autofocus>
				<span class="glyphicon glyph form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group">
				<a href="index.php?act=login">Назад к форме входа</a>
			</div>

			<button id="btn_recover_login" class="btn btn-lg btn-primary btn-block" type="submit">Восстановить</button>
			
		</form>
	</div>
	<script src="js/recover_login.js"></script>
  </body>
</html>
