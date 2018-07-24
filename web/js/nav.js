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