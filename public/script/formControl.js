/*
* При полной загрузке документа
* мы начинаем определять события
*/
$(document).ready(function () {
    $('#disc_id').change(function() {
        // Если группа и дисциплина выбрана
        // Подгружаем данные
        // alert($('#group_id').val());
        // alert($('#disc_id').val());

        if ( ($('#group_id').val() != 0) &&
        ($('#disc_id').val() != 0) ) {

            groups_id   = $('#group_id').val(); 
            disc_id     = $('#disc_id').val(); 

            var req = "group_id=" + groups_id;
            req     += "&disc_id=" + disc_id;            
            req_upd = req + "&updateDate=true";

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

                        // Очищаем от данных если они есть 
                        $('table > thead').remove();
                        $('table > tbody').remove();
                        // Восстанавливаем каркас
                        $('table').append('<thead><tr><th style="border:none"></th><tr></thead><tbody></tbody>');

                        var options = '';
                        var td = '<td></td><td></td><td></td><td></td>' +
                                    '<td></td><td></td><td></td><td></td><td></td><td></td>';
                        
                        $(json.list).each(function() {
                            options += '<tr><td>' + $(this).attr('Name') + ' ' + $(this).attr('Surname') + 
                            '</td>' + '</tr>';
                        });
                        
                        $('table > tbody:last-child').append(options);
                    }        
                },
            });


            $.ajax ({
                url: 	'',
                method: 'GET',
                data:   req_upd,
                cache:      false,
                contentType:    false,
                processData:    false,

                success: function(result) {
                    json = 		jQuery.parseJSON(result);  

                    var options = '';
                    $(json.date).each(function(){
                        options += '<th>' + $(this).attr('datetime') + '</th>';
                    });
                    $('table > thead > tr:first-child').append(options);
                    console.log(json);
                },
            });



        }
    });
});
