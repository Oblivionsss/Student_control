// Загрузка групп и дисциплин
$(document).ready(function () {

        // req     += "&uniq=" + true;
        $.ajax ({
            url: 	'/api/groups/',
            method: 'GET',
            // data:   req,
            cache:  false,
            contentType:    false,
            processData:    false,

            success: function(result) {
                json = 		jQuery.parseJSON(result);
                
                if (json.status && json.status == 201) {
                    var options = '<option value="0">- выберите группу -</option>';
                    
                    $(json.data).each(function() {
                        options += '<option value="' + $(this).attr('id') + '">' + $(this).attr('NameOfGrups') + '</option>';
                    });
                    
                    $('select[name="groups_id"]').each(function() {
                        $(this).html(options);
                    });
                }        
            },
        });

        $.ajax ({
            url: 	'/api/disc/',
            method: 'GET',
            // data:   req,
            cache:  false,
            contentType:    false,
            processData:    false,

            success: function(result) {
                json = 		jQuery.parseJSON(result);
                
                if (json.status && json.status == 201) {
                    var options = '<option value="0">- выберите группу -</option>';
                    
                    $(json.data).each(function() {
                        options += '<option value="' + $(this).attr('id') + '">' + $(this).attr('Name') + '</option>';
                    });
                    
                    $('select[name="disc_id"]').each(function() {
                        $(this).html(options);
                    });
                }        
            },
        });      

});
