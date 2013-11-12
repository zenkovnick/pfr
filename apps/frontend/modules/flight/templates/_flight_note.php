<div class='note-form-wrapper'>
    <textarea class="flight-note" name="flight[flight_note]"><?php echo $flight->getFlightNote() ? $flight->getFlightNote() : '' ?></textarea>
    <button type="submit" class="submit btn btn-green"><?php echo $flight->getFlightNote() ? 'Update Note' : 'Add Note' ?></button>
</div>
<script type='text/javascript'>
    jQuery('.submit').bind('click', function(event){
        event.preventDefault();
        var btn = jQuery(this);
        var note = jQuery('.flight-note').val();
        jQuery.ajax({
            url: '<?php echo url_for("@flight_note_process?id={$flight->getId()}") ?>',
            dataType: 'json',
            data: {note: note},
            type: 'post',
            success: function(data) {
                if(data.result == 'OK'){
                    var root_li = btn.closest('li');
                    var form = jQuery('.note-form', root_li);
                    var open_link = jQuery('.flight-note-link', root_li);
                    if(note){
                        open_link.text('Update Note');
                    } else {
                        open_link.text('Add Note');
                    }
                    form.removeClass('open').hide(500);
                    jQuery('.note-form-wrapper', form).remove();
                }
            }

        });

    });
</script>
