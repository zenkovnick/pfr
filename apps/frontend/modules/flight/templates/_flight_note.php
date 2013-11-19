<div class='note-form-wrapper'>
    <textarea class="flight-note" name="flight[flight_note]" placeholder="Make a note and press Submit"><?php echo $flight->getFlightNote() ? $flight->getFlightNote() : '' ?></textarea>
    <button class="cancel btn btn-grey">Cancel</button>
    <button class="submit btn btn-green">Submit</button>
</div>
<script type='text/javascript'>
    jQuery('.submit').bind('click', submitNote);
    jQuery('.cancel').bind('click', cancelNote);

    function submitNote(event){
        event.preventDefault();
        var btn = jQuery(this);
        var note = jQuery('.flight-note').val();
        var root_li = btn.closest('li');
        var form = jQuery('.note-form', root_li);
        var open_link = jQuery('.flight-note-link', root_li);
        jQuery.ajax({
            url: '<?php echo url_for("@flight_note_process?id={$flight->getId()}") ?>',
            dataType: 'json',
            data: {note: note},
            type: 'post',
            success: function(data) {
                if(data.result == 'OK'){
                    if(note){
                        open_link.text('update note');
                    } else {
                        open_link.text('add note');
                    }
                    form.removeClass('open').hide(500);
                    jQuery('.note-form-wrapper', form).remove();
                }
            }

        });

    }

    function cancelNote(event){
        event.preventDefault();
        var btn = jQuery(this);
        var root_li = btn.closest('li');
        var form = jQuery('.note-form', root_li);
        form.removeClass('open').hide(500);
        jQuery('.note-form-wrapper', form).remove();
    }

</script>
