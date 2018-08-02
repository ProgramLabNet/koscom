//скрыть/раскрыть меню навигации на маленких устройствах
;(function(){
	$(document).ready(function(){
		//раскрыть и скрыть меню навигации на маленьких размерах экрана
		$(".nav-header-button").click(function(){
			$(".for-users").slideToggle(500);
		});
		
		//проверка размера окна экрана до определенных размеров
		$(window).resize(function(){
			if($(window).width() > 992){
				$(".for-users").removeAttr('style');
			}
		});
		
	});
})();

//предотвратить клик на родительских элементах
;(function(){
	$(document).ready(function(){
            $(".main-parent").click(function(e){
                var next = $(this).next()[0];
                var next_class = $(next).attr('class');
                if(next_class == "sub-menu"){
                    e.preventDefault();
                }
            });
	});
})();