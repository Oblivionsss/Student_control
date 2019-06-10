/*
* При полной загрузке документа
* мы начинаем определять события
*/
var groups_id;  // id группы (группа привязана к студенту)
var disc_id;    // id уникальной группы-дисциплины-преподавателя


 // Функция получения списка студентов
 function getStud(req, req_upd) {
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
                var leftElem = '<thead><tr><th>' +
                '</th></tr></thead><tbody></tbody>';

                $('table').append(leftElem);
                
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
    getDate(req_upd);
}


function getDate(req_upd) {
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
            
            if (json.status && json.status == '404') {
                return false;
            }

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
                        
                        
                        // Если 0 - значит студента не было
                        if (param['status'] === '0') {
                            options += '<td data-id=' + param['id'] + 
                            ' data-status="' + param['status'] + 
                            '"> <i class="fa fa-times"> </i> </td>';
                        }
                        
                        // null игнорируем
                        else if (param['status'] === null ||
                        param['status'] == '') {
                            options += '<td data-id=' + param['id'] + 
                            ' data-status="null"> </td>';
                        }
                        
                        // Если 1 - студент был
                        else if (param['status'] == 1) {
                            options += '<td data-id=' + param['id'] + 
                            ' data-status=" ' + param['status'] + 
                            '"> <i class="fa fa-check"> </i></td>';
                        }
                        
                        // Иначе записываем как есть
                        else {
                            options += '<td data-id=' + 
                            param['id'] + ' data-status="' + 
                            param['status'] + '">' + 
                            param['status'] + '</td>';
                        }                    
                    }); 
                    // Формируем таблицу успеваемости
                    $('[data-id-students="' + key + '"]').after(options);

                });
            });
       
            // Добавляем стрелки
            $('table > thead > tr > th:first-child').append('<i class="fa fa-2x fa-chevron-left"></i>');
            $('table > thead > tr > th:last-child').after('<th><i class="fa fa-2x fa-chevron-right"></i></th>');         

        },
    });

} 


$(document).ready(function () {
    $('#disc_id').change(function() {
        
        // Если группа и дисциплина выбрана
        // Подгружаем данные
        // В disc_id уникальный ключ свзяки teachid-discid-grpid



        if ( ($('#group_id').val() != 0) &&
        ($('#disc_id').val() != 0) ) {
            groups_id   = $('#group_id').val(); 
            disc_id     = $('#disc_id').val(); 
        } else return;

        // Запрос на список студентов
        var req = "group_id=" + groups_id +
        "&all=" + true;            
            
        // Запрос на данные посещаемости
        var req_upd = "disc_id=" + disc_id +
        "&updateDate=true";          
        
        navig();
        getStud(req, req_upd);  // Загружаем список студентов   
    });
});

 

function navig() {
        
        // Добавляем функцию прокрутки
        // Вешаем обработчик на кнопку подгрузки для кнопки слева
        $('table').on("click", ".fa-chevron-left", function() {
            // определяем дату 
            var req = "group_id=" + groups_id +
            "&all=" + true;            
                
            // Запрос на данные посещаемости
            var req_upd = "disc_id=" + disc_id +
            "&updateDate=true";  


            var data    = $(this).parent().next().attr('data-ish');
            req_upd     += '&days=' + data;

            getStud(req, req_upd);       // Загружаем список студентов


        });
        // Для кнопки справа
        $('table').on("click", ".fa-chevron-right", function() {
            // определяем дату 
            var req = "group_id=" + groups_id +
            "&all=" + true;            
                
            // Запрос на данные посещаемости
            var req_upd = "disc_id=" + disc_id +
            "&updateDate=true";  


            var data    = $(this).parent().prev().attr('data-ish');
            req_upd     += '&days=' + data;
            
            getStud(req, req_upd);       // Загружаем список студентов

        });
}