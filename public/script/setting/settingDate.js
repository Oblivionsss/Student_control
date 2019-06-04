$(document).ready(function() {
    
    // Сначала подгружаем данные
    $.ajax ({
        url: 	'/api/users_info/',
        method: 'GET',
    
        cache:  false,
        contentType:    false,
        processData:    false,
        
        success: 		function(result) {
            json = 		jQuery.parseJSON(result); 

            // Получаем редирект
            if (json.url) {
                window.location.href = json.url;
            } 

            // Получаем сообщение 
            else if (json.status == 200 ||
                    json.status  == 404) {
                alert (json.data);
            }
            
            // Получаем гет ответ
            else if (json.status && json.status == 201) {
                $('input').each(function() {
                    // Если существует пересечение name формы
                    // и ключей объекта json.data
                    // значит заполняем данными

                    // Ключ
                    var key     = $(this).attr('name');
                    
                    // Значение
                    var value   = json.data[0][$(this).attr('name')];
                    
                    if( key ) {
                        $(this).attr( 'value', value );
                    }
                });
            }
        },
    });

    // Теперь устанавливаем обработчик событий на форму
    // Обновляем данные, если нажали обновить 
    $('form').submit(function () {
        
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

                    // Получаем редирект
                    if (json.url) {
                        window.location.href = json.url;
                    } 
        
                    // Получаем сообщение 
                    else if (json.status == 200 ||
                            json.status  == 404) {
                        alert (json.data);
                    }

                    else if (json.status && json.status == 201) {
                        // Если обновление прошло успешно
                        // Обновляем страницу
                        window.location.reload();
                    }
                },
            });
            return false;
        
	});	

});