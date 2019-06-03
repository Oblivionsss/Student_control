$(document).ready(function() {
	$('form').submit(function () {
		
		event.preventDefault();

				var formID = $(this).attr('id'); // Получение ID формы
				var formNm = $('#' + formID);

			$.ajax({
				url: 	$(formNm).attr('action'),
				type:	$(formNm).attr('method'),
				data: 		new FormData(formNm),
				cache: 					false,
				contentType:			false,
				processData:			false,
				
				success: 		function(result) {
					json = 		jQuery.parseJSON(result);

					if (json.url) {
						window.location.href = json.url;
					} 
					else if (json.status && json.message) {
						alert(json.message);
					}
				},
			});
			return false;
	});	
});