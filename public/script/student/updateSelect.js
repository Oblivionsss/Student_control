/*
* При полной загрузке документа
* мы начинаем определять события
*/

// Подгружаем второй select
$(document).ready(function () {

    var urlgrp  = '/api/groups/';
    var urldsc  = '/api/disc/';

    // Подзапрос на получение индивидуальных групп и дисц.
    var uniq    = '?uniq=' + true;


    $.ajax ({
        url: 	urlgrp + uniq,
        method: 'GET',
        cache:  false,
 
        contentType:    false,
        processData:    false,

        success: function(result) {
            json = 		jQuery.parseJSON(result);
            
            if (json.status && json.status == 201) { 
                var options = '<option value="0">- выберите группу -</option>';

                $(json.data).each(function() {
                    options += '<option value="' + $(this).attr('id_group') + '">' + $(this).attr('NameOfGrups') + '</option>';
                });
                $('#group_id').html(options);
                $('#group_id').attr('disabled', false);


            }       

            else if (json.status && json.status == 202) {
                // Отсутсвуют какие-либо уникальные карточки
                return(false);
            }
            
            else alert('Ошибка загрузки данных, обратитесь к администратору');
        },
    });

        // Если данные по группам загрузились, 
        // значит подгружаем данные по дисциплине
    $('#group_id').change(function () {

        // Получаем значение группы
        var groups_id = $('#group_id').val();
        
        if (groups_id == '0') {
            $('#disc_id').html('<option>- выберите дисциплину -</option>');
            return(false);
        }
        
        $('#disc_id').attr('disabled', true);
        $('#disc_id').html('<option>загрузка...</option>');
        
        urldsc  += uniq;
        urldsc  += "&groups_id=" + groups_id;
        
        $.ajax ({
            url: 	urldsc,
            method: 'GET',

            cache:  false,
            contentType:    false,
            processData:    false,

            success: function(result) {
                json = 		jQuery.parseJSON(result);
                
                if (json.status && json.status == 201) { 
                    var options = '<option value="0">- выберите дисциплину -</option>';
                    
                    // в id - уникальный ключ связки teach-group-disc
                    $(json.data).each(function() {
                        options += '<option value="' + $(this).attr('id') + '">' + $(this).attr('Name') + '</option>';
                    });
                    $('#disc_id').html(options);
                    $('#disc_id').attr('disabled', false);
                }       

                else if (json.status && json.status == 202) {
                    // Отсутсвуют какие-либо уникальные карточки
                    return(false);
                }
                
                else alert('Ошибка загрузки данных, обратитесь к администратору');
            },
        });
    });
});