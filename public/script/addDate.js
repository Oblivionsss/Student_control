/*
* При полной загрузке документа
* мы начинаем определять события
*/

// Подгружаем второй select
$(document).ready(function () {
    $('#group_id').change(function () {
        
        var groups_id = $(this).val();
        
        if (groups_id == '0') {
            $('#disc_id').html('<option>- выберите дисциплину -</option>');
            $('#disc_id').attr('disabled', true);
            return(false);
        }
        
        $('#disc_id').attr('disabled', true);
        $('#disc_id').html('<option>загрузка...</option>');
        
        var req = "group_id=" + groups_id;
        $.ajax ({
            url: 	'',
            method: 'GET',
            data:   req,
            cache:  false,
            contentType:    false,
            processData:    false,

            success: function(result) {
                json = 		jQuery.parseJSON(result);
                
                if (json.type == 'error') {
                    return(false);
                }
                
                else {
                    var options = '';

                    $(json.disc).each(function() {
                        options += '<option value="' + $(this).attr('id_disc') + '">' + $(this).attr('Name') + '</option>';
                    });
                    $('#disc_id').html(options);
                    $('#disc_id').attr('disabled', false);

                }        
            },
        });

        // Если поля не пустые - отправляем данные на сервер
   
            
            $('form').submit(function () {
                event.preventDefault();
                stopImmediatePropagation();
                // if ($('#group_id').val() !== 0 &&
                // $('#disc_id').val() !== 0) {
                    var formID = $(this).attr('id'); // Получение ID формы
                    var formNm = $('#' + formID);
                    $.cookie
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
                    return false;
                // }
                // else alert("Введите пожалуйста все данные!");
            });
        
    });
});
