$(document).ready(function() {
	$('form').submit(function () {
		
		event.preventDefault();

				var formID = $(this).attr('id'); // Получение ID формы
				var formNm = $('#' + formID);

				console.log(this);
			$.ajax({
				url: 	$(this).attr('action'),
				type:	$(this).attr('method'),
				data: 		new FormData(this),
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