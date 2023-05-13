jQuery( document ).ready(function($) {


    //Dismissable Control
    $('#st-topbar-cta.top,#st-topbar-cta.bottom').on('click', '.st-topbar-cta-collapse', function(){
        $( '#st-topbar-cta' ).slideUp(500);
        $( '.st-topbar-cta-collapse-open' ).slideDown(500);

        $.cookie('st_topbar_cta_dismissable', true, { expires: 7, domain: window.location.hostname, path: '/' });

    });

    $('body').on('click', '.st-topbar-cta-collapse-open', function(){
            $( this ).slideUp(500);
            $( '#st-topbar-cta' ).slideDown(500);
            
            $.cookie('st_topbar_cta_dismissable', false, { expires: 7, domain: window.location.hostname, path: '/' });
    });

    // Retrieve
    if ( $.cookie('st_topbar_cta_dismissable') === 'true' ) {
        $( '#st-topbar-cta' ).hide();
        $( '.st-topbar-cta-collapse-open' ).show();
    } else {
        $( '.st-topbar-cta-collapse-open' ).hide();

    }

});
