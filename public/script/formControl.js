/*
* При полной загрузке документа
* мы начинаем определять события
*/
$(document).ready(function () {
    $('#disc_id').change(function() {
        // Если группа и дисциплина выбрана
        // Подгружаем данные
        // В disc_id уникальный ключ свзяки teachid-discid-grpid

        if ( ($('#group_id').val() != 0) &&
        ($('#disc_id').val() != 0) ) {

            groups_id   = $('#group_id').val(); 
            disc_id     = $('#disc_id').val(); 

            var req = "group_id=" + groups_id;
            req     += "&all=" + true;            
            
            
            var req_upd = "disc_id=" + groups_id;
            req_upd     += "&updateDate=true";

            $.ajax ({
                url: 	'/api/student/' ,
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

                        // Очищаем от данных если они есть 
                        $('table > thead').remove();
                        $('table > tbody').remove();
                        // Восстанавливаем каркас
                        $('table').append('<thead><tr><th style="border:none"></th><tr></thead><tbody></tbody>');

                        var options = '';
                        
                        // Формируем шаблон под столбец с ФИО студентами
                        // Каждой записи будет соответствовать свой id;
                        $(json.data).each(function() {
                            options += '<tr><td data-id-students="' + 
                            $(this).attr('id') + '">' + 
                            $(this).attr('Surname') + ' ' 
                            + $(this).attr('Name') + 
                            '</td>' + '</tr>';
                        });
                        
                        $('table > tbody:last-child').append(options);
                    }        
                },
            });

            // Загружаем дату и данные по посещаемости
            $.ajax ({
                url: 	'/api/studentControl/',
                method: 'GET',
                data:   req_upd,
                cache:      false,
                contentType:    false,
                processData:    false,

                success: function(result) {
                    json = 		jQuery.parseJSON(result);  

                    var options = '';

                    // Формируем строку с датами
                    $(json.date).each(function(){
                        options += '<th>' + $(this).attr('datetime') + '</th>';
                    });
                    $('table > thead > tr:first-child').append(options);
                    
                    // Формируем строки с успеваемостью
                    $(json.infoStud).each(function(index, value) {    

                        $.each(this, function (key, values)  {
                            options = '';
                            
                            $.each(values, function (keys, param){
                                // console.log(key);
                                // console.log(param['status']);
                                if (param['status'] === null) {
                                    options += '<td></td>';
                                }
                                else
                                    options += '<td>' + param['status'] + '</td>';
                            });

                            $('[data-id-students="' + key + '"]').after(options);
                        });
                    });
                },
            });
        }
    });
});
