// Подгружаем загрузка расписания

$(document).ready(function () {

    $.ajax ({
        url:    '/api/groups_disc_info/',
        method: 'GET',
        cache:  false,
 
        contentType:    false,
        processData:    false,

        success: function(result) {
            json = 		jQuery.parseJSON(result);
            
            // Если данные отсутствуют
            if (json.status && json.status == 202) { 
                alert('Данные отсутствуют');
            }       
            
            // Если данные пришли 
            else if (json.status && json.status == 200) {
                // console.log(json.data);
                // Сформируем заголовки
                var title = "<tr>" +
                    "<th> Дата" + "</th>" +
                    "<th> Пара" + "</th>" +
                    "<th> Предмет" + "</th>" +
                    "<th> Группа" + "</th>" +
                    "<th> Аудитория" + "</th>" +
                "</tr>";

                $('table').append(title);

                var options     = "";
 
                $(json.data).each(function(e, key) {
                    $.each(key, function(keys, values){

                        // Определяем количество строк для объединения
                        var length  = values.length;
                        
                        // Меняем формат даты
                        var option  = {
                            month: 'long',
                            day: 'numeric',
                            weekday: 'long',
                        }
                        var data    = new Date(keys);
                        data        = data.toLocaleString("ru", option);
                        
                        // Формируем таблицу
                        if ( length > 1 ){
                            options     += "<tr>";
                            options     += "<td class='bolder' rowspan='" + length + "'>" + data + "</td>";
                            
                            $.each(values, function(k, val){
                                if (k != 0) {
                                    options     += "<tr>";
                                } 

                                options     += "<td>" + $(val).attr('par') + "</td>" +
                                "<td>" + $(val).attr('name') + "</td>" +
                                "<td>" + $(val).attr('NameOfGrups') + "</td>" +
                                "<td>" + $(val).attr('lectureHall') + "</td></tr>";
                            });
                        }
                        else if ( length == 1 ) {
                            $.each(values, function(k, val){
                                options     += "<td class='bolder'>" + data + "</td>" +
                                "<td>" + $(val).attr('par') + "</td>" +
                                "<td>" + $(val).attr('name') + "</td>" +
                                "<td>" + $(val).attr('NameOfGrups') + "</td>" +
                                "<td>" + $(val).attr('lectureHall') + "</td></tr>";
                            });
                        }
                    });
                }); 
        
                $('table > tbody:first-child').append(options);  
            }
        },
    });
});
