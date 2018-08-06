        
;(function(){
        $(document).ready(function(){
            
            $(window).resize( setWrapContentHeight );
            function setWrapContentHeight(){
                var window_height = $(window).height();
                var footer_height = $('.cnt-footer').height();
                var nav_height = $('.wrap .container nav').height();
                var wrap_height = window_height - footer_height - nav_height - 10;
                
                $('.wrap-content').css({
                    height: wrap_height + 'px'
                });
            }
            
            setWrapContentHeight();
            
            
        });
})();
