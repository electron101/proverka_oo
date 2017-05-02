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
				$('#client-panel').removeClass('hidden');
				$('#fio').val(msg.fio);
				$('#doljn').val(msg.doljn);
				$('#otdel').val(msg.name);
				$('#tel').val(msg.tel);
				$('#email').val(msg.email);
				$('#kab').val(msg.kabinet);
			},
			error:function(x,s,d)
			{
				alert(d);
			}
		});
	}
  });
});
