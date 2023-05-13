jQuery( document ).ready(function($) {
    //Switch Control
    $('body').on('click', '.st-onoffswitch', function(){
        var $this = $(this);
        if($this.hasClass('switch-on')){
            $(this).removeClass('switch-on');
            $this.next('input').val( false ).trigger('change')
        }else{
            $(this).addClass('switch-on');
            $this.next('input').val( true ).trigger('change')
        }
    });
});
