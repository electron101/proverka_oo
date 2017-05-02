$(function() 
{
  //при отправке нажатии на кнопку отправления данных
  $('#btn_edit').click(function(event) 
  {
	//отменить стандартное действие браузера
	event.preventDefault();
	//завести переменную, которая будет говорить о том валидная форма или нет
	var formValid = true;
	//перебирает все элементы управления формы (input и textarea) 
	$('#ReisEditForm input,textarea').each(function() 
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
	  var bort_num      = $("#bort_num").val();

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

		if (bort_num == null) 
		{		
			// получаем элемент, содержащий пароль
			inputuser = $("#bort_num");
			//найти предка, имеющего класс .form-group (для установления success/error)
			formGroupuser = inputuser.parents('.form-group');
			//добавить к formGroup класс .has-error и удалить .has-success
			formGroupuser.addClass('has-error').removeClass('has-success');
			
			formValid = false;
		}
	});

	//если форма валидна, то
	if (formValid) 
	{	
		var date_posadka2 = $('#date_posadka').val();
		// var date_vilet2 = $('#date_vilet').val(moment(new Date($('#date_vilet').val())).format("YYYY-MM-DD HH:mm:ss"));
		var date_vilet2 = $('#date_vilet').val();

		var str = $('#ReisEditForm').serialize();

		str += "&date_posadka2=" + date_posadka2 + "&date_vilet2=" + date_vilet2;
		$.ajax(
		{
			url: "scripts/reis_edit.php",
			type: "POST",
			data: str
		})
			.done(function(msg) 
			{
				// если сервер всё выполнил удачно то
				if(msg == "success")
				{
					//скрыть форму
					$('#ReisEditForm').hide();
					//удалить класс hidden
					$('#success-alert').removeClass('hidden');
					$('#success-alert-btn').removeClass('hidden');
				}
				if(msg == "invalid")
				{
					//скрыть форму
					$('#ReisEditForm').hide();
					//удалить класс hidden
					$('#danger-alert').removeClass('hidden');
					$('#success-alert-btn').removeClass('hidden');
				}
			})	
	}
  });
});
