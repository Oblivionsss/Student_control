$(document).ready(function() {
	
	$('form').submit(function(event) {
		
		var json;
		event.preventDefault();

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
				else if (json.status && json.status) {
					alert(json.status + ' - ' + json.message);
				}
			},
		});
	});
});