/**
 * Spin 2 Win Admin Css 
 **/
 jQuery(document).ready(function(){
    jQuery("#tabs").tabs();
    
    jQuery(window).trigger('hashchange');
    
    jQuery(".spin2winColorpicker").wpColorPicker();
    
    //Number of segement repeator
    jQuery("#spin2winNoSegment").keyup(function(){
        jQuery(this).trigger("change");
    })
    jQuery("#spin2winNoSegment").change(function(){
        var noSegment = parseInt( jQuery(this).val() );
        jQuery('input#spin2winNoSegment + div.spinner').css("visibility", "visible");
        
        var noExtRow = jQuery("#spin2winSettingTbl").find('tr.segmentRow');
        template = segementTemplate.innerHTML;
        var i=noExtRow.length;
        for(i; i < noSegment; i++){
            console.log( i );
            var temp = template.replace(/{{numSegment}}/g, i);
            jQuery(".form-table tbody").append( temp);
        }
        jQuery(".spin2winColorpicker").wpColorPicker();
        
        // remove more than requested fields
        if( noSegment < noExtRow.length ){
            for( var i = noExtRow.length; i >= noSegment; i--) {
                jQuery("#spin2winSettingTbl").find('tr.segmentRow:eq('+i+')').remove();
            }
        }
        jQuery('input[type=submit]').trigger('click');
    });
    
    
    //image uploader
    jQuery('body').on('click', '.upload-image', function( e ) {
        var that = jQuery(this);
        var _orig_send_attachment = wp.media.editor.send.attachment;
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media ) {
                that.val(attachment.url);
                jQuery("#spin2winBackImg").attr("src", attachment.url).removeClass("hidden");
                
                jQuery("#spin2win-admin .the_wheel").css("background-image", "url(" + attachment.url +")");
            } else {
                return _orig_send_attachment.apply( this, [props, attachment] );
            }
        }
        wp.media.editor.open(jQuery(this));
        return false;
    });
    
    //set background 
    jQuery("#spin2win-admin .the_wheel").css("background-image", "url(" + SPIN2WINP.spin2win_background_img +")");
    //theWheel
    $default_options = SPIN2WINP.settings;
    $default_options.animation = SPIN2WINP.animation;
    $default_options.segments = SPIN2WINP.segments;
    $default_options.animation.duration = parseInt($default_options.animation.duration);
    $default_options.animation.spins = parseInt($default_options.animation.spins);
    $default_options.textLineWidth = isNaN(parseInt($default_options.textLineWidth)) ? null : parseInt($default_options.textLineWidth);
    $default_options.textMargin = isNaN(parseInt($default_options.textMargin)) ? null : parseInt($default_options.textMargin);
    $default_options.textFontSize = parseInt($default_options.textFontSize);
    $default_options.lineWidth = parseInt($default_options.lineWidth);
    $default_options.textFontSize = parseInt($default_options.textFontSize);
    $default_options.outerRadius = parseInt($default_options.outerRadius);
    $default_options.innerRadius = parseInt($default_options.innerRadius);
    $default_options.numSegments = parseInt($default_options.numSegments);
    
    var theWheel = new Winwheel( $default_options );
    
    function changeSegment(){
        var currentVal = jQuery(this).val();
        var currentVal = isNaN(parseInt(currentVal)) ? null : parseInt(currentVal);
        theWheel.noSegment= currentVal;
    }
    
    jQuery("#spin2win-admin input").change(function(){
        updateWheel();
    })
     
    jQuery('.wp-color-picker').wpColorPicker({
        /**
         * @param {Event} event - standard jQuery event, produced by whichever
         * control was changed.
         * @param {Object} ui - standard jQuery UI object, with a color member
         * containing a Color.js object.
         */
        change: function (event, ui) {
            var element = event.target;
            var color = ui.color.toString();
            updateWheel();
        },
        option: function function_name(argument) {
            updateWheel();
        },
    
        /**
         * @param {Event} event - standard jQuery event, produced by "Clear"
         * button.
         */
        clear: function (event) {
            var element = jQuery(event.target).siblings('.wp-color-picker')[0];
            var color = '';
            if (element) {
                updateWheel();
            }
        }
    });
     
    jQuery('select').on('change', function() {
        updateWheel();
    })

     function updateWheel(){
         var innerRadius = jQuery("input[name='spin2win-popup-plugin[settings][innerRadius]'").val();
         var outerRadius = jQuery("input[name='spin2win-popup-plugin[settings][outerRadius]'").val();
         var lineWidth = jQuery("input[name='spin2win-popup-plugin[settings][lineWidth]'").val();
         var strokeStyle = jQuery("input[name='spin2win-popup-plugin[settings][strokeStyle]'").val();
         var textFontFamily = jQuery("#textFontFamily").val();
         var textFontWeight = jQuery("#textFontWeight").val();
         var textOrientation = jQuery("#textOrientation").val();
         var textAlignment = jQuery("#textAlignment").val();
         var textDirection = jQuery("#textDirection").val();
         var textFontSize = jQuery("input[name='spin2win-popup-plugin[settings][textFontSize]'").val();
         var textMargin = jQuery("input[name='spin2win-popup-plugin[settings][textMargin]'").val();
         var textStrokeStyle = jQuery("input[name='spin2win-popup-plugin[settings][textStrokeStyle]'").val();
         var textLineWidth = jQuery("input[name='spin2win-popup-plugin[settings][textLineWidth]'").val();
         var textFillStyle = jQuery("input[name='spin2win-popup-plugin[settings][textFillStyle]'").val();
         
         theWheel.innerRadius = parseInt(innerRadius);
         theWheel.outerRadius = parseInt(outerRadius);
         theWheel.lineWidth = parseInt(lineWidth);
         theWheel.strokeStyle = strokeStyle;
         theWheel.textFontFamily = textFontFamily;
         theWheel.textFontWeight = textFontWeight;
         theWheel.textOrientation = textOrientation;
         theWheel.textFontSize = parseInt(textFontSize);
         theWheel.textMargin = parseInt(textMargin);
         theWheel.textStrokeStyle = textStrokeStyle;
         theWheel.textLineWidth = textLineWidth;
         theWheel.textFillStyle = textFillStyle;
         theWheel.textAlignment = textAlignment;
         theWheel.textDirection = textDirection;
         
         //segments
         var noSegment = jQuery("input[name='spin2win-popup-plugin[settings][numSegments]'").val();
         theWheel.numSegments = parseInt(noSegment);
         var $count = 1;
        for( i = 0 ; i < noSegment ;i++){
            var text = jQuery("input[name='spin2win-popup-plugin[segments]["+i+"][text]']").val();
            var style = jQuery("input[name='spin2win-popup-plugin[segments]["+i+"][fillStyle]']").val();
            if( style == '') {
                style = "#000";
            }
            theWheel.segments[$count].fillStyle = style;
            theWheel.segments[$count].text = text;
            
            $count ++;
        }
         
        theWheel.draw();
     }
        
 })
 
 