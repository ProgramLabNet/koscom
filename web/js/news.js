;(function(){
    $(document).ready(function(){
        /* Переменная-флаг для отслеживания того, происходит ли в данный момент ajax-запрос. В самом начале даем ей значение false, т.е. запрос не в процессе выполнения */
        var inProgress = false;
        /* С какой статьи надо делать выборку из базы при ajax-запросе */
        var startFrom = 12;
        
        $(window).scroll(function() {
            
            /* Если высота окна + высота прокрутки больше или равны высоте всего документа и ajax-запрос в настоящий момент не выполняется, то запускаем ajax-запрос */
            if($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !inProgress) {

                $.ajax({
                    /* адрес файла-обработчика запроса */
                    url: 'news/ajax',
                    /* метод отправки данных */
                    method: 'POST',
                    /* данные, которые мы передаем в файл-обработчик */
                    data: {"startFrom" : startFrom},
                    /* что нужно сделать до отправки запрса */
                    beforeSend: function() {
                    /* меняем значение флага на true, т.е. запрос сейчас в процессе выполнения */
                    inProgress = true;}
                    /* что нужно сделать по факту выполнения запроса */
                }).done(function(data){

                    /* Преобразуем результат, пришедший от обработчика - преобразуем json-строку обратно в массив */
                    data = jQuery.parseJSON(data);
                    
                    /* Если массив не пуст (т.е. статьи там есть) */
                    if (data.length > 0) {
                        
                        /* Делаем проход по каждому результату, оказвашемуся в массиве,
                        где в index попадает индекс текущего элемента массива, а в data - сама статья */
                        $.each(data, function(index, value){
                            
                            /* Отбираем по идентификатору блок со статьями и дозаполняем его новыми данными */
                            $(".row").append('<div class="col-lg-3 news-cols">' +
                                                    '<div class="news-size">' +
                                                        '<div class="news-image"><a class="link-img" href="/news/article?id='+ value.id +'"><div class="img-hover"></div><img src="' + (value.preview_image ? "/web/uploads/preview/" + value.preview_image : "/web/public/no_image.png")  + '" alt=""></a></div>' +
                                                        '<div class="news-text">'+
                                                            '<span class="news-title"><a href="/news/article?id='+ value.id +'">' + value.title + '</a></span>' +
                                                            '<span class="news-created">Новости&nbsp&nbsp&ndash;&nbsp&nbsp'+ value.created_at +'</span>' +
                                                            '<span class="news-more"><a href="/news/article?id='+ value.id +'">Подробнее...</a></span>'
                                                        + '</div>'
                                                    + '</div>'
                                                + '</div>');
                        });

                        /* По факту окончания запроса снова меняем значение флага на false */
                        inProgress = false;
                        // Увеличиваем на 10 порядковый номер статьи, с которой надо начинать выборку из базы
                        startFrom += 12;
                    }
                });
            }
        });
    });
})();


