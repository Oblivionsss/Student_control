// Меняем стили 
// При изменении отправляем данные на сервервер
// в формате
// ajax( id - записи, значение статуса')

$('table').on('click', 'i', function(){
    console.log(11);
    // Счетчик на пустые ячейки
    // переключатель с состояния- "был" на "не был"
    if ($(this).attr( "class" ) == 'fa fa-check') {
       
        $( this ).removeClass( "fa-check" );
        $( this ).parent().attr('data-status', '0');

        // отправка данных на сервер
        ajax( $(this).parent().attr('data-id'), $(this).parent().attr('data-status'), 'PUT', 'STUD' );
        
        $( this ).addClass( "fa-times" );
        
    }
    
    // переключает с состояния "не был" на данных нет
    else if ($(this).attr( "class" ) == 'fa fa-times'){
        // console.log(11);
        $( this ).parent().attr( 'data-status', 'null' );
        
        // отправка данных на сервер
        ajax( $(this).parent().attr('data-id'), '', 'PUT', 'STUD' );
        
        $( this ).remove();
        $(this).attr();
    }
});



// переключатель с пустой ячейки на ячейку с состоянием "был" 
$('table').on('click', '[data-status="null"]',function(){
    $(this).append('<i class="fa fa-check"></i>');
    $(this).attr('data-status', '1');
    
    // отправка данных на сервер
    ajax( $(this).attr('data-id'), $(this).attr('data-status'), 'PUT', 'STUD' );
});



// Обработка преобразования данных в исходный формат
$('table' ).on('click', '.ish', function(){
    // var number_1 = $('th > ul > li >' + this);
    var number  = $(this).parent().parent().parent().parent().index(); 
    // console.log(number);
    rechange (number);
});

function rechange (number) {
    // Список ячеек столбца
    var elem    = $('tr > td:nth-child(' + (number + 1) + ')' );
    elem.each(function () {
        // this - елемент td
        // Сохраняем исходное значение status
        var status = $(this).attr('data-status');


        if (status == 'null' ) {
            $(this).attr('data-status', '');
            status = '';
        }
        // Очищаем поле td
        $(this).empty();    
        // вставляем инпут
        $(this).append('<input class="inpChange" size="1" value="'+ status + '">'); 
    });
}

// Функция обаботки инпутов
// Данны отправляются при смене фокуса
$('table').on('blur', '.inpChange', function() {

    var parent = $(this).parent();
    // Смена data-status
    parent.attr('data-status', $(this).val());
    
    // console.log(parent.attr('data-status'));
    // отправка данных на сервер
    ajax( parent.attr('data-id'), parent.attr('data-status'), 'PUT', 'STUD' );
})



// Отправка запроса на удаление дня 
$('table').on('click', '.delete', function(){
    // Определяем дату удаления
    // console.log( $(this).parent().parent().parent().parent().attr('data-ish'));
    var elem   = $(this).parent().parent().parent().parent();

        // Дополнительное уточнение
    if (confirm("Удалить данные за эту дату?")) {
        // Отправляем данные на удаление
        ajax( elem.attr('data-ish'), '0', 'DELETE', 'DAYS' );
        
        // Обновляем интерфейс
        console.log(elem.index());
        delColumn(elem.index());
    }
    else return;
});


// Удаление столбца
function delColumn(numb) {
    // Удаляем заголовок таблицы
    // console.log($('thead > th:nth-child(' + numb + ')'));
    $('tr > th:nth-child(' + (numb + 1) + ')').remove();
    
    // Удаляем остально содержимое столбцов
    // console.log($('thead > th:nth-child(' + ($numb+1) + ')'));
    $('tr > td:nth-child(' + (numb + 1) + ')').remove();
}


// Расширить на более гибкое изменение данных//
// обновляем данные 
function ajax(id, status, method, variable) {
    // формируем строку запроса
    var req     = '';
    var id_uniq = $('#disc_id').val();

    if (variable == 'STUD') {
        req = '?method=' + method +
        '&id=' + id +
        '&status=' + status;    
    }

    else if (variable == 'DAYS') {
        req = '?method=' + method +
        '&days=' + id +
        '&uniq=' + id_uniq;
    }
        
    var url     = '/api/studentControl/'; 
    console.log(req); 
    $.ajax ({  
        url: 	url + req,
        method: 'POST',

        cache:  false,
        contentType:    false,
        processData:    false,

        success: function(result) {
            json = 		jQuery.parseJSON(result);

            if (json.status && json.status == 202) {
                console.log(json.data);
            }

            else console.log('errors');
        }
    });
}

