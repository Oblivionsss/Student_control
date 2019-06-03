$(document).ready(function() {
	$('form').submit(function () {
		
		event.preventDefault();

				var formID = $(this).attr('id'); // Получение ID формы
				var formNm = $('#' + formID);

			$.ajax({
				url: 	$(this).attr('action'),
				type:	$(this).attr('method'),
				data: 		new FormData(this),
				cache: 					false,
				contentType:			false,
				processData:			false,
				
				success: 		function(result) {
					json = 		jQuery.parseJSON(result);

					// Отображаем ответ сервера
					if (json.status == 200 ||
						json.status  == 404) {
						alert (json.data);
					}

					else if (json.status && json.status == 201) {
						alert(json.data);
					}

					// if (json.url) {
					// 	window.location.href = json.url;
					// } 
					// else if (json.status && json.message) {
					// 	alert(json.message);
					// }
				},
			});
			return false;
	});	
});