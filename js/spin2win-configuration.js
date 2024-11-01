// Create new wheel object specifying the parameters at creation time.
$default_options = {
    'innerRadius'     : 0,         // Make wheel hollow so segments don't go all way to center.

    'numSegments'  : 5,     // Specify number of segments.
    'outerRadius'  : 212,   // Set outer radius so wheel fits inside the background.
    'textFontSize' : 28,    // Set font size as desired.
    'lineWidth'    : 10, 
    'fillStyle'    : 'silver',     // The segment background colour.
    'strokeStyle'  : '#da0000',      // Segment line colour. Again segment lines only drawn if this is specified.
    'textFontFamily'    : 'Arial',      // Segment text font, you should use web safe fonts.
    'textFontSize'      : 25,           // Size of the segment text.
    'textFontWeight'    : 'bold',       // Font weight.
    'textOrientation'   : 'curved', // Either horizontal, vertical, or curved.
    'textAlignment'     : 'center',     // Either center, inner, or outer.
    'textDirection'     : 'normal',     // Either normal or reversed. In normal mode for horizontal text in segment at 3 o'clock is correct way up, in reversed text at 9 o'clock segment is correct way up.
    'textMargin'        : 0,         // Margin between the inner or outer of the wheel (depends on textAlignment).
    'textFillStyle'     : 'white',      // This is basically the text colour.
    'textStrokeStyle'   : 0,         // Basically the line colour for segment text, only looks good for large text so off by default.
    'textLineWidth'     : 1,            // Width of the lines around the text. Even though this defaults to 1, a line is only drawn if textStrokeStyle specified.

    'segments'     :        // Define segments including colour and text.
    [
    {'fillStyle' : '#eae56f', 'text' : 'Prize 1'},
    {'fillStyle' : '#89f26e', 'text' : 'Prize 2'},
    {'fillStyle' : '#7de6ef', 'text' : 'Prize 3'},
    {'fillStyle' : '#e7706f', 'text' : 'Prize 4'},
    {'fillStyle' : '#da0000', 'text' : 'Prize 5'},
    ],
    'animation' :           // Specify the animation to use.
    {
      'type'     : 'spinToStop',
        'duration' : 5,     // Duration in seconds.
        'spins'    : 4,     // Number of complete spins.
        'callbackFinished' : 'alertPrize()',
        'callbackBefore'  : 'callBackAfter()',
      }
    };

//override default value falue
jQuery().extend($default_options, SPIN2WINP.settings);
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

// Vars used by the code in this page to do power controls.
var wheelSpinning = false;

// -------------------------------------------------------
// Click handler for spin button.
// -------------------------------------------------------
function startSpin()
{
     resetWheel();
    // Ensure that spinning can't be clicked again while already running.
    if (wheelSpinning == false)
    {
        theWheel.startAnimation();
        
        // Set to true so that power can't be changed and spin button re-enabled during
        // the current animation. The user will have to reset before spinning again.
        wheelSpinning = true;
      }
    }

// -------------------------------------------------------
// Function for reset button.
// -------------------------------------------------------
function resetWheel()
{
    theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
    theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
    theWheel.draw();                // Call draw to render changes to the wheel.
    
    // document.getElementById('pw1').className = "";  // Remove all colours from the power level indicators.
    // document.getElementById('pw2').className = "";
    // document.getElementById('pw3').className = "";
    
    wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
  }

// -------------------------------------------------------
// Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters.
// -------------------------------------------------------
function alertPrize() {
    // Get the segment indicated by the pointer on the wheel background which is at 0 degrees.
    var winningSegment = theWheel.getIndicatedSegment();
    
    // Do basic alert of the segment text. You would probably want to do something more interesting with this information.
    // alert("You have won " + winningSegment.text);
    jQuery("#resultText").html(SPIN2WINP.spin2win_result_view.replace(/{{prize}}/g, winningSegment.text));
    
    
    jQuery(".mc-embedded-subscribe-form").show();
    jQuery(".inputField").show();
    jQuery("#firstModel").modal("hide");
    jQuery("#myModal").modal({
        backdrop: 'static',
        keyboard: false
    });
    // resetWheel();
}

function callBackAfter(){
    var currentSegment = theWheel.getIndicatedSegmentNumber();
    var x = document.getElementById("myAudio"); 
    x.play();
}

function submitEmailForm(){
    var email_address = jQuery("#emailSub").val();
    if( email_address == '') {
        return ;
    }
    
    jQuery("#myModal .submitBtn").disabled = true;
    jQuery("#myModal .submitBtn").text("Wait...");
    
    jQuery.ajax({
        type:"POST",
        url: SPIN2WINP.ajax_url,
        data: {
            action: "mailchimp_subscription",
            email_address: email_address
        },
        success:function(data){
            data = JSON.parse(data);
            if( data.status == 400 ){
                alert(data.detail);
                jQuery("#myModal .submitBtn").disabled = false;
                jQuery("#myModal .submitBtn").text("Subscribe")
            }else{
                jQuery(".mc-embedded-subscribe-form").hide();
                jQuery(".inputField").hide();
                jQuery("#resultText").html(SPIN2WINP.spin2win_result_after_submit);
                jQuery("#closeAllModel").removeClass("hidden");
            }
        },
        error: function(errorThrown){
            console.log(errorThrown);
            jQuery("#myModal .submitBtn").disabled = false;
            jQuery("#myModal .submitBtn").text("Subscribe")
        } 
    
    });

}

function closeAllModel(){
  jQuery("#firstModel").modal("hide");
}

jQuery("#firstModelBtn").click(function(){
    jQuery("#firstModel").modal({
        backdrop: 'static',
        keyboard: false
    });
})

jQuery(document).ready(function(){
    // if you want to use the 'fire' or 'disable' fn,
    // you need to save OuiBounce to an object
    if(SPIN2WINP.display.exit_intent == 1) {
        var _ouibounce = ouibounce(document.getElementById('firstModel'), {
            aggressive: false,
            timer: 0,
            callback: function() { jQuery("#firstModel").modal("show");console.log('ouibounce fired!'); }
        });
    }else{
        var time = SPIN2WINP.display.time; 
        if( time == undefined) {
            time = 1;
        }
        setTimeout(function(){
            jQuery("#firstModel").modal("show");
        }, parseInt(time) * 1000 * 60 )
    }
})
