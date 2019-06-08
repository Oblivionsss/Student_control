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
            
            
            var req_upd = "disc_id=" + disc_id;
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
                        $('table').append('<thead><tr><th></th><tr></thead><tbody></tbody>');

                        var options = '';
                        
                        // Формируем шаблон под столбец с ФИО студентами
                        // Каждой записи будет соответствовать свой id;
                        $(json.data).each(function() {
                            options += '<tr><td data-id-students="' + 
                            $(this).attr('id') + '">' +
                            $(this).attr('Surname') + ' ' +  
                            $(this).attr('Name') + 
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
                    $(json.data[0]['datetime']).each(function(key, value){
                        // К каждой дате добавляем список с возможностью настройки
                        options += '<th data-ish="' + value[1] +  
                        '">' + value[0] + 
                        '<ul style="position:relative; z-index:1000;">'+
                            '<li class="hide_show">' +
                                '<i class="fa fa-cog"></i>' +
                                '<ul class="list">' +
                                    '<li class="list ish">исх. данные</li>' +
                                    '<li class="list delete">удалить день</li>' +
                                '</ul>' +
                            '</li>' +	
                        '</ul>' +                                     
                        '</th>';
                    });
                    $('table > thead > tr:first-child').append(options);
                    


                    // Формируем строки с успеваемостью
                    $(json.data[1]).each(function(index, value) {    
                        
                        $.each(this, function (key, values)  {
           
                            options = '';
                            
                            $.each(values, function (keys, param){
                                // param['id] -id уникальной записи в бд
                                // param['status] значение по успеваемости
                                // сортируем данные 
                                
                                if (param['status'] === '0') {
                                    options += '<td data-id=' + param['id'] + 
                                    ' data-status="' + param['status'] + 
                                    '"> <i class="fa fa-times"> </i> </td>';
                                }
                                else if (param['status'] === null ||
                                    param['status'] == '') {
                                    options += '<td data-id=' + param['id'] + 
                                    ' data-status="null"> </td>';
                                }
                                
                                else if (param['status'] == 1) {
                                    options += '<td data-id=' + param['id'] + 
                                    ' data-status=" ' + param['status'] + 
                                    '"> <i class="fa fa-check"> </i></td>';
                                }
                                
                                else {
                                    options += '<td data-id=' + 
                                    param['id'] + ' data-status="' + 
                                    param['status'] + '">' + 
                                    param['status'] + '</td>';
                                }

                            }); 
                            $('[data-id-students="' + key + '"]').after(options);
                        });
                    });
                    // Устанавливаем обработчик событий на каждую ячейку таблицы               
                },
            }); 
                          
        }
    });
});


