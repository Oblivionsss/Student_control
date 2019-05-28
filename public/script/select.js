/*
* При полной загрузке документа
* мы начинаем определять события
*/
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
                    var options = '<option value="0">- выберите дисциплину -</option>';
                                        
                    $(json.disc).each(function() {
                        options += '<option value="' + $(this).attr('id_disc') + '">' + $(this).attr('Name') + '</option>';
                    });
                    $('#disc_id').html(options);
                    $('#disc_id').attr('disabled', false);

                }        
            },
        });

        if ($('#group_id').val() !== 0 &&
        $('#disc_id').val() !== 0) {
            
        }




    });
});
