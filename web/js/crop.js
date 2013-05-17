/*
 * Upload and resize image and than crop it
 * */

var image_name;

function showCoords(c)
{
    $('#logo_crop_x1').val(c.x);
    $('#logo_crop_y1').val(c.y);
    $('#logo_crop_x2').val(c.x2);
    $('#logo_crop_y2').val(c.y2);
    $('#logo_crop_w').val(c.w);
    $('#logo_crop_h').val(c.h);
};

function clearCoords()
{
    $('#coords input').val('');
    $('#h').css({color:'red'});
    window.setTimeout(function(){
        $('#h').css({color:'inherit'});
    },500);
};

function init_crop(upload_url, crop_url, default_image, crop_min_size, upload_type, form_field_id)
{
//    jQuery('#remove_image').click(function(){
//        jQuery('#photo').attr('src', default_image );
//        jQuery('#'+form_field_id).val('');
//        jQuery('#remove_image').hide();
//        return false;
//    });
//
//    jQuery('#fancyboxcrop_show').fancybox({
//        autoDimensions: true
//    });
    jQuery('#sf_guard_user_avatar').fileupload({
        url: upload_url,
        forceIframeTransport: true,
        done: function (e, data) {
            //console.log(data.result);
            var response = jQuery(data.result).find('html body').html();
            //alert(response);
            var object = eval('(' + response + ')');
            /*response = "<HTML>"+response+"</HTML>";
            var response_html = null;
            var object = null;
            var node_list;
            var node;
            if(window.DOMParser){
                var parser = new DOMParser();
                response_html = parser.parseFromString(response, 'text/xml');
                node_list = response_html.getElementsByTagName("body")[0];
                node = node_list.childNodes[0];
                object = eval('(' + node.nodeValue + ')');
            }
            else{
                response_html = new ActiveXObject('Microsoft.XMLDOM');
                response_html.async = false;
                response_html.validateOnParse = false;
                var parse_result = response_html.loadXML(response);
                if (parse_result){
                    node_list = response_html.getElementsByTagName("BODY")[0];
                    node = node_list.childNodes[0];
                    object = eval('(' + node.nodeValue + ')');
                }
                else{
                    var perr = response_html.parseError;
                    alert(perr.reason + "at line " + perr.line + " character " + perr.linepos);
                }

            }*/

            var file_name = null;
            var file_url = null;
            for(var obj in object){
                if(object.hasOwnProperty(obj)){
                    for(var prop in object[obj]){
                        if(object[obj].hasOwnProperty(prop)){
                            if(prop == 'name'){
                                file_name = object[obj][prop];
                            }else if(prop == 'url'){
                                file_url = object[obj][prop];
                            }
                        }
                    }
                }
            }

                    //jQuery.each(data.result, function (index, file) {
                //console.log(index);
                //console.log(file);
//                image_name = file.name;
//                jQuery('.jcrop-holder').remove();
                jQuery('#avatar-container').html('<img id="temp_image" src="'+file_url+'">').removeClass("default-avatar");
                jQuery('#sf_guard_user_uploaded_avatar').val(file_name);
//                jQuery('<img id="temp_image" src="'+file.url+'">').html(jQuery('#avatar-container'));
//                //jQuery('#crop-form').html('<img id="temp_image" src="'+file.url+'">');
//                jQuery('#fancyboxcrop_show').trigger('click');
//                jQuery('#temp_image').Jcrop({
//                    onChange:   showCoords,
//                    onSelect:   showCoords,
//                    onRelease:  clearCoords,
//                    setSelect: [0, 0, crop_min_size[0], crop_min_size[0]],
//                    aspectRatio: 1,
//                    minSize: crop_min_size
//                });
           // });
        }
    });

//    jQuery('#crop_image').click(function(){
//        jQuery.ajax({
//            url: crop_url,
//            dataType: 'json',
//            type: 'post',
//            data: {
//                'logo_crop[x1]': jQuery('#logo_crop_x1').val(),
//                'logo_crop[y1]': jQuery('#logo_crop_y1').val(),
//                'logo_crop[x2]': jQuery('#logo_crop_x2').val(),
//                'logo_crop[y2]': jQuery('#logo_crop_y2').val(),
//                'logo_crop[w]': jQuery('#logo_crop_w').val(),
//                'logo_crop[h]': jQuery('#logo_crop_h').val(),
//                'file': image_name,
//                'type': upload_type
//            },
//            success: function(data)
//            {
//                if (data.status == 'Ok')
//                {
//                    jQuery('#'+form_field_id).val(data.file);
//                    jQuery('#photo').attr('src', data.url);
//                    jQuery.fancybox.close();
//                    jQuery('#remove_image').show();
//                }
//                jQuery('#temp_image').remove();
//                jQuery('.jcrop-holder').remove();
//            }
//        });
//        return false;
//    });
}
