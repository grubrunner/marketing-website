jQuery(document).ready(function($) {

    $('.ec-shortcode-display-value, .ec-shortcode-template-display-value').click(function(){
        $(this).focus();
        $(this).select();
        document.execCommand('copy');
        $(this).siblings('.ec-copied-info').show().delay(1000).fadeOut();
    });

	var $container = $('.ec-counter-main-wrap');

    //// random number generator
    function randomString(len, charSet) {
        charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var randomString = '';
        for (var i = 0; i < len; i++) {
            var randomPoz = Math.floor(Math.random() * charSet.length);
            randomString += charSet.substring(randomPoz,randomPoz+1);
        }
        return randomString;
    }

    function rearrangeColumnsIndex() {
        var column_outer_wrapper = $container.find('.ec-add-append-wrap'),
            columns = column_outer_wrapper.find('.ec-count-item-wrap');
        for (var i = 0; i<columns.length; i++) {
            var current_column = columns.eq(i);
            var all_inputs = current_column.find('[name*="item"]'),
                    random_string = randomString(10);
                for (var j = 0; j<all_inputs.length; j++) {
                    var current_input = all_inputs[j];
                    if (current_input.type !== undefined) {
                        current_input.setAttribute('name', current_input.getAttribute('name').replace(/item\[([a-zA-Z0-9]+)?\]/g, 'item[' +random_string+ ']'));
                    }
                }
            current_column.find('.ec-item-header-title').html('Item '+(i+1));
        }
    }

    $container.on('change', '.ec-image-upload-url', function(){
        alert('changed');
    });

	$('.ec-icon-picker').iconPicker();
    $container.on('click', '.ec-image-upload-button', function (e) {
        e.preventDefault();
        var $this = $(this);
        var image = wp.media({
            title: 'Upload Image',
            multiple: false
        }).open()
                .on('select', function (e) {
                    var uploaded_image = image.state().get('selection').first();
                    var el_img_url = uploaded_image.toJSON().url;
                    $($this).closest('.ec-item').find('.ec-image-upload-url').val(el_img_url);
                    $($this).closest('.ec-item').find('.ec-image-preview img').attr('src', el_img_url);
                });
    });

    $container.on('change', '.ec-icon-selection', function(e){
    	var $val = $(this).val();
    	if($val == 'icon'){
    		$(this).closest('.ec-item-font-or-image-selection').find('.ec-count-item-font-icon').fadeIn();
    		$(this).closest('.ec-item-font-or-image-selection').find('.ec-count-item-image').fadeOut();
    	}else if( $val=='image' ){
    		$(this).closest('.ec-item-font-or-image-selection').find('.ec-count-item-image').fadeIn();
    		$(this).closest('.ec-item-font-or-image-selection').find('.ec-count-item-font-icon').fadeOut();
    	}else{
    		$(this).closest('.ec-item-font-or-image-selection').find('.ec-count-item-image').fadeOut();
    		$(this).closest('.ec-item-font-or-image-selection').find('.ec-count-item-font-icon').fadeOut();
    	}
    });

    $container.find('.ec-color-picker').wpColorPicker();

    $container.on('click', '.ec-count-item-inner-header', function(){
        $(this).closest('.ec-item-section-wrap').find('.ec-count-item-inner-body').slideToggle('slow');
        $(this).find('.ec-item-section-hide-show').toggleClass('ec-active');
    });

    $container.on('click', '.ec-item-header-title, .ec-item-hide-show', function(){
        $(this).closest('.ec-count-item-wrap-inner').find('.ec-count-item-body').slideToggle('slow');
        $(this).toggleClass('ec-active');
    });

    $container.on('click', '.ec-checkbox-enable-option', function() {
        var $this = $(this);
    	if ($this.is(':checked')) {
          $this.closest('.ec-item').find(".ec-checkbox-enabled-option").show();
        }else{
    		$this.siblings(".ec-checkbox-enabled-option").hide();
    	}
    });

    /** Sortable initialization */
    $('.ec-add-append-wrap').sortable({
        items:'.ec-count-item-wrap',
        containment: 'parent',
        handle: '.ec-item-shorting',
        tolerance: 'pointer',
        cursor: "move",
        update: function() {
                        rearrangeColumnsIndex();
                    }
    });

    // add items using ajax only
    $container.on('click', '.ec-add-counter-button', function(e){
        var $this = $(this),
        $parent = $this.closest('.ec-counter-main-wrap').find('.ec-add-counter-wrap'),
        action = $this.data('action'),
        append_div = $parent.find('.ec-add-append-wrap');
        if($parent.find('.ec-count-item-wrap').length <=100){
            //add new column action using ajax since there is no column at all
            if(action == 'add_item'){
                $('.ec-loader-image').show();
                var action_to_perform = 'add_item';
                $.ajax({
                    url : ajaxurl,
                    type : 'post',
                    data : {
                        action : 'backend_ajax',
                        _action: action_to_perform,
                        _wpnonce:ec_backend_ajax.ajax_nonce
                        },
                    success : function( response ) {
                        append_div.append(response);
                        $('.ec-add-counter-wrap .ec-color-picker').wpColorPicker();
                        $('.ec-add-counter-wrap .ec-icon-picker').iconPicker();
                        rearrangeColumnsIndex();
                        $('.ec-loader-image').hide();

                    }
                });
            }
            e.preventDefault();
        }else{
            alert('Sorry. Maximum number of column exceeded.');
        }
    });

    $container.on('click', '.ec-item-delete', function(e){
        var $this = $(this);
        if(confirm($(this).data('confirm'))){
            $this.closest('.ec-count-item-wrap').remove();
            rearrangeColumnsIndex();
            e.preventDefault();
        }else{
            e.preventDefault();
        }
    });

    $container.on('click', '.ec-item-copy', function(e){
        var $this = $(this);
        if(confirm($(this).data('confirm')) ){
            if($(this).closest('.ec-add-append-wrap').find('.ec-count-item-wrap').length <=100){
                var $outerwrapper = $this.closest('.ec-counter-main-wrap').find('.ec-add-append-wrap');
                var $orginal = $this.closest('.ec-count-item-wrap');
                var cloned_item = $this.closest('.ec-count-item-wrap').clone();
                cloned_item.find('.wp-color-result').remove();
                var all_inputs = cloned_item.find('[name*="item"]'),
                    random_string = randomString(10);
                for (var j = 0; j<all_inputs.length; j++) {
                    var current_input = all_inputs[j];
                    if (current_input.type !== undefined) {
                        current_input.setAttribute('name', current_input.getAttribute('name').replace(/item\]\[([a-zA-Z0-9]+)?\]/g, 'item][' +random_string+ ']'));
                    }
                }
                //get original selects into a jq object
                var $originalSelects = $orginal.find('select');
                cloned_item.find('select').each(function(index, item) {
                     //set new select to value of old select
                     $(item).val( $originalSelects.eq(index).val() );
                });
                $outerwrapper.append(cloned_item);
                e.preventDefault();
                rearrangeColumnsIndex();
                $('.ec-add-counter-wrap .ec-color-picker').wpColorPicker();
                $('.ec-add-counter-wrap .ec-icon-picker').iconPicker();
            }else{
                alert("Sorry. Maximum number of rows exceeded.");
                e.preventDefault();
            }
        }else{
            e.preventDefault();
        }
    });

    // display settings
    $container1 = $('.ec-display-settings-wrap');
    $container1.on('click', '.ec-tab', function(){
        var $this = $(this),
        id = $this.attr('id');
        $('.ec-tab').removeClass('ec-active');
        $this.addClass('ec-active');
        $('.ec-tab-content').removeClass('ec-tab-content-active').hide();
        $('.'+id).addClass('ec-tab-content-active').show();
    });

    $container1.on('change', '.ec-img-selector', function(){
        var selected_img = $(this).find('option:selected').data('img');
        $(this).closest('.ec-template-selection-options-wrap').find('.ec-img-selector-media img').attr('src', selected_img);

    });

    $container1.find('.slider-range-max').each(function(){
        var $this = $(this);
        var $min     = $this.closest('.ec-template-input-wrap').find('.ec-input-field').data('min');
        var $max     = $this.closest('.ec-template-input-wrap').find('.ec-input-field').data('max');
        var $value   = $this.closest('.ec-template-input-wrap').find('.ec-input-field').val();
        $this.slider({
            range: "max",
            min: $min,
            max: $max,
            value: $value,
            slide: function( event, ui ) {
              $this.closest('.ec-template-input-wrap').find('.ec-input-field').val( ui.value );
            }
          });
    });

    // background select options change function

    $container1.find('.ec-color-picker').wpColorPicker();

    $container1.on('change', '.ec-select-options', function(){
        var $this = $(this);
        var val = $this.val();
        var parent = $this.closest('.ec-options-wrap').find('.ec-background-select-content');
        if( val =='' ){
            parent.find('.ec-common-content-wrap').hide();
            parent.find('.ec-common-content-wrap-all').hide();
        }else if(val=='background-color'){
            parent.find('.ec-common-content-wrap').hide();
            parent.find('.ec-common-content-wrap-all').hide();
            parent.find('.ec-'+val).show();
        }else{
            parent.find('.ec-common-content-wrap').hide();
            parent.find('.ec-common-content-wrap-all').show();
            parent.find('.ec-'+val).show();
        }
    });

    $container1.on('click', '.ec-image-upload-button', function (e) {
        e.preventDefault();
        var $this = $(this);
        var image = wp.media({
            title: 'Upload Image',
            multiple: false
        }).open()
                .on('select', function (e) {
                    var uploaded_image = image.state().get('selection').first();
                    var el_img_url = uploaded_image.toJSON().url;
                    $this.closest('.ec-options-wrap').find('.ec-image-upload-url').val(el_img_url);
                    $this.closest('.ec-options-wrap').find('.ec-image-preview img').attr('src', el_img_url);
                });
    });

    $container1.on('click', '.ec-image-overlay-enable-option', function(){
        if ($(this).is(':checked')) {
            $(this).closest('.ec-checkbox-outer-wrap').find(".ec-checkbox-checked-options").fadeIn();
        }else{
            $(this).closest('.ec-checkbox-outer-wrap').find(".ec-checkbox-checked-options").fadeOut();
        }
    });

    $container1.on('change', '.ec-video-select-option', function(){
        var $this = $(this);
        var val = $this.val();
        $this.closest('.ec-options-wrap').find('.ec-common-content-wrap-inner').hide();
        $this.closest('.ec-options-wrap').find('.ec-'+val).show();
    });
});