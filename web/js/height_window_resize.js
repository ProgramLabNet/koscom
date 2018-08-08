;(function(){
        $(document).ready(function(){
            
            $(window).resize( setWrapContentHeight );
            function setWrapContentHeight(){
                var window_height = $(window).height();
                var footer_height = $('.cnt-footer').height();
                var wrap_height = window_height - footer_height;
                $('.wrap-background').css({
                    height: wrap_height + 'px'
                });
                
                console.log(wrap_height);
            }
            
            setWrapContentHeight();
            
            $(window).resize(function () {
                setWrapContentHeight();
            });
        });
})();
