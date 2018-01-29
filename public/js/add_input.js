jQuery(document).ready(function($) {
    var max_fields      = 4; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><div style="display:inline-block"><select name="start_location" title="Select a locationrental-manage" required><option>Any location</option></select></div><div><select name="add_stop_wait[]" class="form-control"  required="required" title="Waiting Time" id="add-stop-wait"><option value="">Waiting Time</option><option value="1">30 minutes</option><option value="2">1 hour</option><option value="3">1 hour 30 minutes</option><option value="4">2 hour</option><option value="5">2 hour 30 minutes</option><option value="6">3 hour</option><option value="7">3 hour 30 minutes</option><option value="8">4 hour</option></select></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
