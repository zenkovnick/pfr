function rotateBlogContent() {
    if(jQuery('#blogpost_type').val() == 'image') {
        jQuery('#image_cnt').show();
        jQuery('#video_embed_code_cnt').hide();
        jQuery('#video_image_cnt').hide();
        jQuery('#audio_embed_code_cnt').hide();
        jQuery('#audio_image_cnt').hide();
        jQuery('#collage_type_cnt').hide();
        jQuery('#text_image_cnt').hide();
    } else if(jQuery('#blogpost_type').val() == 'video') {
        jQuery('#image_cnt').hide();
        jQuery('#video_embed_code_cnt').show();
        jQuery('#video_image_cnt').show();
        jQuery('#audio_embed_code_cnt').hide();
        jQuery('#audio_image_cnt').hide();
        jQuery('#collage_type_cnt').hide();
        jQuery('#text_image_cnt').hide();
    } else if(jQuery('#blogpost_type').val() == 'audio') {
        jQuery('#image_cnt').hide();
        jQuery('#video_embed_code_cnt').hide();
        jQuery('#video_image_cnt').hide();
        jQuery('#audio_embed_code_cnt').show();
        jQuery('#audio_image_cnt').show();
        jQuery('#collage_type_cnt').hide();
        jQuery('#text_image_cnt').hide();
    } else if(jQuery('#blogpost_type').val() == 'collage') {
        jQuery('#image_cnt').hide();
        jQuery('#video_embed_code_cnt').hide();
        jQuery('#video_image_cnt').hide();
        jQuery('#audio_embed_code_cnt').hide();
        jQuery('#audio_image_cnt').hide();
        jQuery('#collage_type_cnt').show();
        jQuery('#text_image_cnt').hide();
    } else if(jQuery('#blogpost_type').val() == 'text') {
        jQuery('#image_cnt').hide();
        jQuery('#video_embed_code_cnt').hide();
        jQuery('#video_image_cnt').hide();
        jQuery('#audio_embed_code_cnt').hide();
        jQuery('#audio_image_cnt').hide();
        jQuery('#collage_type_cnt').hide();
        jQuery('#text_image_cnt').show();
    }
}